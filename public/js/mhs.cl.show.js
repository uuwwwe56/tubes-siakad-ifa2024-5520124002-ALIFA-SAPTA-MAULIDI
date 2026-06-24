
    function toggleEditForm(tugasId) {
        const form = document.getElementById(`edit-form-${tugasId}`);
        if(form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    }
