<!-- SweetAlert2 Modern Dialog & Notification Engine + Offline Bootstrap Modal Fallback -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  .swal2-popup.swal2-custom {
    border-radius: 16px !important;
    padding: 24px 20px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    box-shadow: 0 20px 40px rgba(0, 32, 96, 0.16) !important;
  }
  .swal2-title.swal2-custom-title {
    font-size: 16px !important;
    font-weight: 700 !important;
    color: #1a1c2c !important;
    padding-top: 6px !important;
  }
  .swal2-html-container.swal2-custom-text {
    font-size: 12.5px !important;
    color: #64748b !important;
    margin-top: 8px !important;
    line-height: 1.5 !important;
  }
  #modalGlobalConfirmDelete .modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 32, 96, 0.2);
  }
</style>

<!-- Offline/Fallback Modern Bootstrap Modal -->
<div class="modal fade" id="modalGlobalConfirmDelete" tabindex="-1" aria-hidden="true" style="z-index: 99999;">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
    <div class="modal-content text-center p-4">
      <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: #fee2e2; color: #dc2626;">
        <span class="material-symbols-outlined" style="font-size: 30px;">warning</span>
      </div>
      <h6 class="fw-bold text-dark mb-2" style="font-size: 16px;">Konfirmasi Hapus Data</h6>
      <p class="text-secondary small mb-4" id="modalGlobalConfirmText" style="font-size: 13px; line-height: 1.5;">Apakah Anda yakin ingin menghapus data ini?</p>
      <div class="d-flex justify-content-center gap-2">
        <button type="button" class="btn btn-light border px-4 py-2 rounded-3 text-secondary fw-semibold small" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold small shadow-sm" id="btnModalGlobalConfirmYes">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  var pendingFormToSubmit = null;

  document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'btnModalGlobalConfirmYes') {
      if (pendingFormToSubmit) {
        pendingFormToSubmit.setAttribute('data-swal-confirmed', 'true');
        var bsModal = bootstrap.Modal.getInstance(document.getElementById('modalGlobalConfirmDelete'));
        if (bsModal) bsModal.hide();
        HTMLFormElement.prototype.submit.call(pendingFormToSubmit);
        pendingFormToSubmit = null;
      }
    }
  });

  // Capture-phase Global Form Submit Interceptor
  document.addEventListener('submit', function (e) {
    var form = e.target;
    if (!form || form.tagName !== 'FORM') return;

    if (form.getAttribute('data-swal-confirmed') === 'true') {
      return true;
    }

    if (form.closest('.modal')) {
      return true;
    }

    var methodInput = form.querySelector('input[name="_method"]');
    var isDelete = methodInput && methodInput.value.toUpperCase() === 'DELETE';
    var onsubmitAttr = form.getAttribute('onsubmit') || '';
    var hasConfirm = onsubmitAttr.includes('confirm(');
    var customMsg = form.getAttribute('data-confirm');

    if (isDelete || hasConfirm || customMsg) {
      e.preventDefault();
      e.stopImmediatePropagation();

      var message = customMsg;
      if (!message && hasConfirm) {
        var match = onsubmitAttr.match(/confirm\(\s*['"](.+?)['"]\s*\)/);
        if (match && match[1]) {
          message = match[1];
        }
      }
      if (!message) {
        message = 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini bersifat permanen.';
      }

      // Check if SweetAlert2 is loaded
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Konfirmasi Hapus Data',
          text: message,
          icon: 'warning',
          iconColor: '#dc2626',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          focusCancel: true,
          customClass: {
            popup: 'swal2-custom',
            title: 'swal2-custom-title',
            htmlContainer: 'swal2-custom-text',
            confirmButton: 'btn btn-danger px-4 py-2 fw-semibold rounded-3 shadow-sm',
            cancelButton: 'btn btn-light border px-4 py-2 fw-semibold rounded-3 text-secondary me-2'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result && result.isConfirmed) {
            form.setAttribute('data-swal-confirmed', 'true');
            HTMLFormElement.prototype.submit.call(form);
          }
        });
      } else {
        // Use modern Bootstrap Modal fallback instead of native confirm
        pendingFormToSubmit = form;
        var textEl = document.getElementById('modalGlobalConfirmText');
        if (textEl) textEl.textContent = message;
        var modalEl = document.getElementById('modalGlobalConfirmDelete');
        if (modalEl && typeof bootstrap !== 'undefined') {
          var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
          modalInstance.show();
        } else {
          // Absolute last resort
          form.setAttribute('data-swal-confirmed', 'true');
          HTMLFormElement.prototype.submit.call(form);
        }
      }

      return false;
    }
  }, true);

  // Flash Message Toasts
  @if(session('success'))
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        iconColor: '#059669',
        title: '{{ addslashes(session('success')) }}',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        customClass: { popup: 'rounded-3 shadow-sm' }
      });
    }
  @endif

  @if(session('error'))
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        iconColor: '#dc2626',
        title: '{{ addslashes(session('error')) }}',
        showConfirmButton: false,
        timer: 4500,
        timerProgressBar: true,
        customClass: { popup: 'rounded-3 shadow-sm' }
      });
    }
  @endif

  @if(session('warning'))
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'warning',
        iconColor: '#d97706',
        title: '{{ addslashes(session('warning')) }}',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        customClass: { popup: 'rounded-3 shadow-sm' }
      });
    }
  @endif
})();
</script>
