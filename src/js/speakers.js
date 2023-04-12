(() => {
    const speakersInput = document.querySelector('#speakers');
    if (!speakersInput) return;

    const speakersUl = document.querySelector('#speakers-list__ul');
    const speakersP = document.querySelector('.speakers-list__p');

    let speakers = [];
    let filteredSpeakers = [];

    // // fn
    const fetchSpeakers = async () => {
        const url = `/api/speakers`;
        const response = await fetch(url);
        const data = await response.json();

        formatSpeakers(data);
    };
    fetchSpeakers();

    const formatSpeakers = (speakersArr = []) => {
        speakers = speakersArr.map(speaker => ({
            name: `${speaker.name.trim()} ${speaker.last_name.trim()}`,
            id: speaker.id,
        }));
    };

    const debounce = (callback, delay) => {
        let timerId;
        return function (...args) {
            if (timerId) {
                clearTimeout(timerId);
            }
            timerId = setTimeout(() => {
                callback.apply(this, args);
                timerId = null;
            }, delay);
        };
    };

    const renderSpeakers = (searchTerm = '') => {
        let html = '';

        if (!filteredSpeakers.length && searchTerm.length >= 3)
            html = `
                <p class="speakers-list__no-results">No hay resultados para tu búsqueda</p>
            `;

        filteredSpeakers.forEach(({ id, name }) => {
            html += `
                <li class="speakers-list__ul__speaker" data-speaker-id=${id}>${name}</li>
            `;
        });

        if (filteredSpeakers.length && searchTerm.length >= 3)
            return (speakersUl.innerHTML = html);

        speakersUl.innerHTML = '';
        speakersP.innerHTML = html;
    };

    // // handlers
    const handleSearch = async e => {
        const searchTerm = e.target.value.toLowerCase().trim();
        if (searchTerm.length < 3) {
            filteredSpeakers = [];
            return renderSpeakers(searchTerm);
        }

        // filteredSpeakers = speakers.filter(speaker =>
        //     speaker.name.toLowerCase().includes(searchTerm)
        // );

        const expression = new RegExp(
            searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'),
            'i'
        );
        filteredSpeakers = speakers.filter(speaker => {
            const speakerName = speaker.name
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLocaleLowerCase('es-ES');
            return speakerName.search(expression) !== -1;
        });

        renderSpeakers(searchTerm);
    };

    let selectedSpeaker;
    const selectSpeaker = e => {
        const clicked = e.target.closest('.speakers-list__ul__speaker');
        if (!clicked) return;

        if (selectedSpeaker) {
            selectedSpeaker.classList.remove(
                'speakers-list__ul__speaker--selected'
            );
        }

        const speakerLi = e.target;
        speakerLi.classList.add('speakers-list__ul__speaker--selected');
        selectedSpeaker = speakerLi;
    };

    // // listeners
    speakersInput.addEventListener(
        'input',
        debounce(function (e) {
            handleSearch(e);
        }, 510)
    );

    speakersUl.addEventListener('click', selectSpeaker);
})();
