(() => {
    const hours = document.querySelector('#hours');
    if (!hours) return;

    const days = document.querySelectorAll('[name=day]');
    const inputHiddenDay = document.querySelector('[name="day_id"]');
    const category = document.querySelector('[name=category_id]');

    const search = {};

    // // handlers
    const searchTerm = e => {
        search[e.target.name] = e.target.value;
        console.log(search);
    };

    // // listeners
    category.addEventListener('change', searchTerm);
    days.forEach(day => day.addEventListener('change', searchTerm));
})();
