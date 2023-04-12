(() => {
    const hours = document.querySelector('#hours');
    if (!hours) return;

    const days = document.querySelectorAll('[name=day]');
    const category = document.querySelector('[name=category_id]');
    const inputHiddenDay = document.querySelector('[name="day_id"]');
    const inputHiddenHour = document.querySelector('[name="hour_id"]');

    const search = {
        category_id: '',
        day: '',
    };

    // // fn
    const fetchEvents = async () => {
        const url = `/api/eventos-horario?day_id=${search.day}&category_id=${search.category_id}`;
        const response = await fetch(url);
        const events = await response.json();

        getAvailableHours(events);
    };

    // // handlers
    const searchTerm = async e => {
        search[e.target.name] = e.target.value;

        // reset
        inputHiddenHour.value = '';
        inputHiddenDay.value = '';
        const previousHourSelected = document.querySelector(
            '.hours__hour--selected'
        );
        if (previousHourSelected)
            previousHourSelected.classList.remove('hours__hour--selected');

        if (Object.values(search).includes('')) return;

        await fetchEvents();
    };

    const selectHour = e => {
        const clicked = e.target.closest('.hours__hour');
        if (!clicked || clicked.classList.contains('hours__hour--disabled'))
            return;

        const hourLi = e.target;

        // add selected class
        const previousHourSelected = document.querySelector(
            '.hours__hour--selected'
        );
        if (previousHourSelected)
            previousHourSelected.classList.remove('hours__hour--selected');

        hourLi.classList.add('hours__hour--selected');

        inputHiddenHour.value = hourLi.dataset.hourId;
        inputHiddenDay.value = document.querySelector(
            '[name="day"]:checked'
        ).value;
    };

    // // listeners
    category.addEventListener('change', searchTerm);

    const getAvailableHours = (events = []) => {
        const allHoursArrUl = [...document.querySelectorAll('#hours li')];

        // reset styles
        allHoursArrUl.forEach(li => li.classList.add('hours__hour--disabled'));

        // available hours
        const hoursTaken = events.map(event => event.hour_id);

        const availableHours = allHoursArrUl.filter(
            li => !hoursTaken.includes(li.dataset.hourId)
        );
        availableHours.forEach(li =>
            li.classList.remove('hours__hour--disabled')
        );

        const hoursUl = document.querySelector('#hours');
        hoursUl.addEventListener('click', selectHour);
    };

    days.forEach(day => day.addEventListener('change', searchTerm));
})();
