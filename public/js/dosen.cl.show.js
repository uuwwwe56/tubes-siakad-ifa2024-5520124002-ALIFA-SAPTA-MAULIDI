 
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function openMateriModal(ptmId) {
            document.getElementById('formMateri').action = '/dosen/classroom/pertemuan/' + ptmId + '/materi';
            openModal('modalMateri');
        }

        function openTugasModal(ptmId) {
            document.getElementById('formTugas').action = '/dosen/classroom/pertemuan/' + ptmId + '/tugas';
            openModal('modalTugas');
        }

        function openGradingModal(submissionId, currentNilai, currentCatatan) {
            document.getElementById('formGrading').action = '/dosen/classroom/submission/' + submissionId + '/nilai';
            document.getElementById('inputNilai').value = currentNilai != 'null' && currentNilai ? currentNilai : '';
            document.getElementById('inputCatatan').value = currentCatatan != 'null' && currentCatatan ? currentCatatan : '';
            openModal('modalGrading');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modals = ['modalPertemuan', 'modalMateri', 'modalTugas', 'modalGrading'];
                modals.forEach(modal => {
                    closeModal(modal);
                });
            }
        });
    