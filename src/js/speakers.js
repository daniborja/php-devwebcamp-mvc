(() => {
    const speakersInput = document.querySelector('#speakers');
    if (!speakersInput) return;

    const speakersUl = document.querySelector('#speakers-list__ul');

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
                <li class="speakers-list__speaker" data-speaker-id=${id}>${name}</li>
            `;
        });

        speakersUl.innerHTML = html;
    };

    // // handlers
    const handleSearch = async e => {
        const searchTerm = e.target.value.toLowerCase().trim();
        if (searchTerm.length < 3) {
            filteredSpeakers = [];
            return renderSpeakers(searchTerm);
        }

        filteredSpeakers = speakers.filter(speaker =>
            speaker.name.toLowerCase().includes(searchTerm)
        );

        renderSpeakers(searchTerm);
    };

    // // listeners
    speakersInput.addEventListener(
        'input',
        debounce(function (e) {
            handleSearch(e);
        }, 510)
    );
})();
