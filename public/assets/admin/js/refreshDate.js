    const dateInput = document.getElementById('dateInput');
    const refreshButton = document.getElementById('refreshDate');

    refreshButton.addEventListener('click', function () {
        const now = new Date();
        const formattedDate = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, '0')}-${now.getDate().toString().padStart(2, '0')} ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}`;
        dateInput.value = formattedDate;
    });



