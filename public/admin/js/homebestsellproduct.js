

document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll('.btn-group button');
    const todayDiv = document.getElementById('todayProductBestSelling-div');
    const monthlyDiv = document.getElementById('monthlyProductBestSelling-div');
    const annualDiv = document.getElementById('annualProductBestSelling-div');
    const allDiv = document.getElementById('allProductBestSelling-div');

    todayDiv.style.display = 'none';
    annualDiv.style.display = 'none';
    allDiv.style.display = 'none';

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            todayDiv.style.display = 'none';
            monthlyDiv.style.display = 'none';
            annualDiv.style.display = 'none';
            allDiv.style.display = 'none';

            switch (button.id) {
                case 'todayProductBestSelling':
                    todayDiv.style.display = 'block';
                    break;
                case 'monthlyProductBestSelling':
                    monthlyDiv.style.display = 'block';
                    break;
                case 'annualProductBestSelling':
                    annualDiv.style.display = 'block';
                    break;
                case 'allProductBestSelling':
                    allDiv.style.display = 'block';
                    break;
            }
        });
    });
});