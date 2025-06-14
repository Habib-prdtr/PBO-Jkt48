    async function cekNotifikasi() {
            console.log("Mengecek notifikasi...");

            try {
              const response = await fetch('../admin/index.php?modul=topUp&fitur=cekNotifikasi');
              const data = await response.json();
              console.log("Data notifikasi:", data);
              console.log("Response JSON:", data);
              console.log("Jumlah Point:", data.jumlahPoint);

              if (data && data.message) {
                if (Notification.permission === "granted") {
                  new Notification("Notifikasi", { body: data.message });
                }

                if (data.status === "success") {
                  showToast(data.message);
                } else if (data.status === "error") {
                  showToastError(data.message);
                }
              }
              else {
                console.log("Tidak ada notifikasi baru.");
              }

            } catch (e) {
              console.error("Gagal fetch notifikasi:", e);
            }
          }

          function showToast(message) {
            const container = document.getElementById("toast-container");

            const toast = document.createElement("div");
            toast.className = `
              flex items-start gap-3 max-w-xs p-4 rounded-2xl bg-green-100 border border-green-300 shadow-lg
              animate-slide-in-fade
            `;

            toast.innerHTML = `
              <div class="flex-shrink-0 mt-1 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <div class="flex-1 text-sm text-green-800">
                ${message}
              </div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
              toast.classList.add("opacity-0", "translate-y-4", "transition-all", "duration-500");
              setTimeout(() => toast.remove(), 500);
            }, 6000);
          }

          function showToastError(message) {
            const container = document.getElementById("toast-container");

            const toast = document.createElement("div");
            toast.className = `
              flex items-start gap-3 max-w-xs p-4 rounded-2xl bg-red-100 border border-red-300 shadow-lg
              animate-slide-in-fade
            `;

            toast.innerHTML = `
              <div class="flex-shrink-0 mt-1 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
              </div>
              <div class="flex-1 text-sm text-red-800">
                ${message}
              </div>
            `;

            container.appendChild(toast);

            setTimeout(() => {
              toast.classList.add("opacity-0", "translate-y-4", "transition-all", "duration-500");
              setTimeout(() => toast.remove(), 500);
            }, 6000);
          }

          document.addEventListener('DOMContentLoaded', function () {
            if (Notification.permission !== "granted") {
                Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    console.log("Notifikasi diizinkan");
                }
                });
            }

            setInterval(cekNotifikasi, 4000); // 5 detik
          });