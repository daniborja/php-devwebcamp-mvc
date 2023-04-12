(() => {
    const speakersInput = document.querySelector('#speakers');
    if (!speakersInput) return;

    let speakers = [];
    let filteredSpeakers = [];

    const fetchSpeakers = async () => {
        const url = `/api/speakers`;
        const response = await fetch(url);
        const data = await response.json();

        formatSpeakers(data);

        console.log(speakers);
    };
    fetchSpeakers();

    const formatSpeakers = (speakersArr = []) => {
        speakers = speakersArr.map(speaker => ({
            name: `${speaker.name.trim()} ${speaker.last_name.trim()}`,
            id: speaker.id,
        }));
    };
})();
