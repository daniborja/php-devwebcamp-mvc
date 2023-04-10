(() => {
    const tagsInput = document.querySelector('#tags_input');
    if (!tagsInput) return;

    const tagsContainer = document.querySelector('#tags');
    const tagsInputHidden = document.querySelector('[name="tags"]');
    let tags = [];

    // fn
    const showTags = () => {
        tagsContainer.textContent = '';

        tags.forEach((tag, i) => {
            const tagHtml = document.createElement('LI');
            tagHtml.classList.add('form__tag');
            tagHtml.textContent = tag;
            tagHtml.dataset['id'] = i;
            tagHtml.ondblclick = deleteTag;
            tagsContainer.appendChild(tagHtml);
        });

        updateInputHidden();
    };

    const deleteTag = e => {
        const index = e.target.dataset.id;
        tags = tags.filter((_, i) => +i !== +index);

        showTags();
    };

    const updateInputHidden = () => {
        tagsInputHidden.value = tags.toString();
    };

    // handlers
    const saveTag = e => {
        if (e.keyCode === 44) {
            e.preventDefault();
            const tag = e.target.value.trim();
            if (!tag.length) return;

            tags = [...tags, tag];
            tagsInput.value = '';

            showTags();
        }
    };

    // listeners
    tagsInput.addEventListener('keypress', saveTag);
})();
