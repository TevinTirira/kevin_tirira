document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('productoForm');
    const nombreInput = document.getElementById('nombre');
    const precioInput = document.getElementById('precio');
    const cantidadInput = document.getElementById('cantidad');

    form.addEventListener('submit', (event) => {
        let valid = true;

        // Validación del nombre
        if (!nombreInput.value.trim()) {
            showError(nombreInput, 'El nombre del producto es requerido.');
            valid = false;
        } else if (/\d/.test(nombreInput.value)) { // Verifica si hay números en el nombre
            showError(nombreInput, 'El nombre del producto no debe contener números.');
            valid = false;
        } else {
            clearError(nombreInput);
        }

        // Validación del precio
        if (!precioInput.value.trim()) {
            showError(precioInput, 'El precio es requerido.');
            valid = false;
        } else if (isNaN(precioInput.value) || parseFloat(precioInput.value) <= 0) {
            showError(precioInput, 'El precio debe ser un número positivo.');
            valid = false;
        } else {
            clearError(precioInput);
        }

        // Validación de la cantidad
        if (!cantidadInput.value.trim()) {
            showError(cantidadInput, 'La cantidad es requerida.');
            valid = false;
        } else if (isNaN(cantidadInput.value) || parseInt(cantidadInput.value) < 0) {
            showError(cantidadInput, 'La cantidad debe ser un número no negativo.');
            valid = false;
        } else {
            clearError(cantidadInput);
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        const errorElement = document.getElementById(input.id + 'Error');
        errorElement.textContent = message;
    }

    function clearError(input) {
        const errorElement = document.getElementById(input.id + 'Error');
        errorElement.textContent = '';
    }
});
