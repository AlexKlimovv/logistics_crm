function setupAutocomplete(inputId, hiddenId, suggestionBoxId) {
    const input = document.getElementById(inputId);
    const hidden = document.getElementById(hiddenId);
    const box = document.getElementById(suggestionBoxId);

    input.addEventListener('input', function () {
        const query = input.value.trim();
        if (query.length < 2) {
            box.innerHTML = '';
            return;
        }

        fetch(`/PhpstormProjects/logistics_crm/controllers/city_search_controller.php?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                box.innerHTML = '';
                data.forEach(city => {
                    const item = document.createElement('div');
                    item.textContent = `${city.name}, ${city.region}, ${city.country}`;
                    item.style.cursor = 'pointer';
                    item.style.padding = '5px';
                    item.style.borderBottom = '1px solid #ccc';

                    item.addEventListener('click', () => {
                        input.value = city.name;
                        hidden.value = city.id;
                        box.innerHTML = '';
                    });

                    box.appendChild(item);
                });
            });
    });

    document.addEventListener('click', function (e) {
        if (!box.contains(e.target) && e.target !== input) {
            box.innerHTML = '';
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    setupAutocomplete('legal_city', 'legal_city_id', 'city_suggestions');
    setupAutocomplete('postal_city', 'postal_city_id', 'postal_city_suggestions');
});
