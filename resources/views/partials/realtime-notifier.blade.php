<!-- Toast Container Realtime -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090;">
  <div id="realtimeLiveToast" class="toast border-0 shadow-lg text-white" role="alert" aria-live="assertive" aria-atomic="true" style="background: #002366; border-radius: 10px;">
    <div class="d-flex align-items-center p-2 px-3 border-bottom border-light border-opacity-10">
      <span class="material-symbols-outlined fs-5 me-2 text-warning animate-pulse">notifications_active</span>
      <strong class="me-auto text-white" id="toastTitle">Pemberitahuan Realtime</strong>
      <small class="text-white-50" id="toastTime">Baru saja</small>
      <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body p-3 text-white" id="toastBody" style="font-size: 12px; line-height: 1.4;">
      Data baru terdeteksi di sistem inventaris.
    </div>
  </div>
</div>

<script>
  (function() {
    let lastReportId = 0;
    const currentUserRole = "{{ auth()->user()?->role ?? 'guest' }}";

    function showRealtimeToast(title, message, isAlert = false) {
      const toastEl = document.getElementById('realtimeLiveToast');
      if (!toastEl) return;

      document.getElementById('toastTitle').innerText = title;
      document.getElementById('toastBody').innerHTML = message;
      document.getElementById('toastTime').innerText = 'Baru saja';

      if (isAlert) {
        toastEl.style.background = '#dc2626';
      } else {
        toastEl.style.background = '#002366';
      }

      const toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 6000 });
      toast.show();
    }

    // Polling Realtime Engine (setiap 5 detik)
    async function checkRealtimeUpdates() {
      try {
        const res = await fetch(`/api/realtime/poll?role=${currentUserRole}&last_id=${lastReportId}`, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (!res.ok) return;

        const data = await res.json();
        if (data.success) {
          // Update badge counter jika ada di navbar/sidebar
          const badgeLaporan = document.querySelectorAll('.badge-unread-laporan, #countLap, #badgeUnreadCount');
          badgeLaporan.forEach(el => {
            if (data.unread_laporan_count > 0) {
              el.innerText = data.unread_laporan_count;
              el.style.display = '';
            } else {
              el.style.display = 'none';
            }
          });

          // Notifikasi laporan baru jika ada
          if (data.has_new && data.new_reports.length > 0) {
            const latest = data.new_reports[0];
            if (lastReportId > 0 && latest.id > lastReportId) {
              if (currentUserRole === 'admin') {
                showRealtimeToast('🔔 Laporan Baru Masuk!', `<b>${latest.pelapor}</b> mengajukan <b>${latest.jenis}</b> untuk <i>${latest.barang}</i> (${latest.ruangan}).`);
              } else if (currentUserRole === 'pj') {
                showRealtimeToast('✅ Status Laporan Diperbarui', `Laporan Anda untuk <b>${latest.barang}</b> telah diperbarui statusnya.`);
              }
            }
            lastReportId = Math.max(lastReportId, ...data.new_reports.map(r => r.id));
          }
        }
      } catch (err) {
        // Silently skip on transient connection drop
      }
    }

    // Inisialisasi polling realtime non-blocking (ringan & tanpa membekukan thread web)
    window.addEventListener('DOMContentLoaded', () => {
      // Jalankan polling awal 1 detik setelah halaman termuat sempurna
      setTimeout(checkRealtimeUpdates, 1000);
      setInterval(checkRealtimeUpdates, 8000);
    });
  })();
</script>
