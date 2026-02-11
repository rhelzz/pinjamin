{{-- Modern Toast Notification Component --}}
<div id="toast-container" class="fixed top-20 right-4 z-[100] flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

{{-- Confirmation Modal --}}
<div id="confirm-modal" class="fixed inset-0 z-[110] hidden">
    <div id="confirm-backdrop" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div id="confirm-dialog" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all w-full max-w-md pointer-events-auto">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-start">
                        <div id="confirm-icon" class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-amber-100">
                            <svg class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="ml-4 text-left flex-1">
                            <h3 id="confirm-title" class="text-lg font-semibold leading-6 text-gray-900">Konfirmasi</h3>
                            <div class="mt-2">
                                <p id="confirm-message" class="text-sm text-gray-600">Apakah Anda yakin ingin melanjutkan?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                    <button type="button" id="confirm-cancel" class="inline-flex justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200">
                        Batal
                    </button>
                    <button type="button" id="confirm-ok" class="inline-flex justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-all duration-200">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toast Notification System
window.Toast = {
    container: null,
    init() {
        this.container = document.getElementById('toast-container');
    },
    
    show(message, type = 'info', duration = 4000) {
        if (!this.container) this.init();
        
        const toast = document.createElement('div');
        toast.className = `toast-item pointer-events-auto transform transition-all duration-300 ease-out translate-x-full opacity-0`;
        
        const configs = {
            success: {
                bg: 'bg-gradient-to-r from-emerald-500 to-green-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
            },
            error: {
                bg: 'bg-gradient-to-r from-red-500 to-rose-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
            },
            warning: {
                bg: 'bg-gradient-to-r from-amber-500 to-orange-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`
            },
            info: {
                bg: 'bg-gradient-to-r from-blue-500 to-indigo-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
            }
        };
        
        const config = configs[type] || configs.info;
        
        toast.innerHTML = `
            <div class="${config.bg} text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 min-w-[280px] backdrop-blur-sm">
                <div class="flex-shrink-0 bg-white/20 rounded-lg p-1.5">
                    ${config.icon}
                </div>
                <p class="flex-1 text-sm font-medium">${message}</p>
                <button class="flex-shrink-0 text-white/80 hover:text-white transition-colors" onclick="this.closest('.toast-item').remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="h-1 mt-1 rounded-full bg-white/30 overflow-hidden">
                <div class="h-full ${config.bg} toast-progress" style="animation: shrink ${duration}ms linear forwards"></div>
            </div>
        `;
        
        this.container.appendChild(toast);
        
        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        });
        
        // Auto remove
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    },
    
    success(message, duration) { this.show(message, 'success', duration); },
    error(message, duration) { this.show(message, 'error', duration); },
    warning(message, duration) { this.show(message, 'warning', duration); },
    info(message, duration) { this.show(message, 'info', duration); }
};

// Confirm Dialog System
window.confirmAction = function(message, title = 'Konfirmasi', type = 'warning') {
    return new Promise((resolve) => {
        const modal = document.getElementById('confirm-modal');
        const backdrop = document.getElementById('confirm-backdrop');
        const titleEl = document.getElementById('confirm-title');
        const messageEl = document.getElementById('confirm-message');
        const iconEl = document.getElementById('confirm-icon');
        const okBtn = document.getElementById('confirm-ok');
        const cancelBtn = document.getElementById('confirm-cancel');
        
        titleEl.textContent = title;
        messageEl.textContent = message;
        
        // Update icon and colors based on type
        const iconConfigs = {
            warning: {
                bgClass: 'bg-amber-100',
                iconClass: 'text-amber-600',
                btnClass: 'from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 shadow-amber-500/30',
                icon: `<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>`
            },
            danger: {
                bgClass: 'bg-red-100',
                iconClass: 'text-red-600',
                btnClass: 'from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-red-500/30',
                icon: `<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>`
            },
            info: {
                bgClass: 'bg-blue-100',
                iconClass: 'text-blue-600',
                btnClass: 'from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-indigo-500/30',
                icon: `<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" /></svg>`
            },
            success: {
                bgClass: 'bg-green-100',
                iconClass: 'text-green-600',
                btnClass: 'from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 shadow-green-500/30',
                icon: `<svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
            }
        };
        
        const config = iconConfigs[type] || iconConfigs.warning;
        iconEl.className = `mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full ${config.bgClass}`;
        iconEl.innerHTML = config.icon.replace('class="h-7 w-7"', `class="h-7 w-7 ${config.iconClass}"`);
        okBtn.className = `inline-flex justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r ${config.btnClass} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200`;
        
        // Show modal with fade-in effect
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 200ms ease-out';
            requestAnimationFrame(() => {
                modal.style.opacity = '1';
            });
        });
        
        const cleanup = () => {
            // Hide modal with fade-out effect
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.opacity = '';
            }, 200);
            okBtn.removeEventListener('click', onOk);
            cancelBtn.removeEventListener('click', onCancel);
            backdrop.removeEventListener('click', onCancel);
            document.removeEventListener('keydown', onEscape);
        };
        
        const onOk = () => { cleanup(); resolve(true); };
        const onCancel = () => { cleanup(); resolve(false); };
        const onEscape = (e) => { if (e.key === 'Escape') onCancel(); };
        
        okBtn.addEventListener('click', onOk);
        cancelBtn.addEventListener('click', onCancel);
        backdrop.addEventListener('click', onCancel);
        document.addEventListener('keydown', onEscape);
    });
};

// Override form submissions with data-confirm attribute
document.addEventListener('DOMContentLoaded', function() {
    Toast.init();
    
    // Handle forms with data-confirm
    document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', async function(e) {
            // Skip if already confirmed
            if (this.dataset.confirmed === 'true') {
                this.dataset.confirmed = 'false'; // reset for next time
                return; // allow form to submit naturally
            }
            
            e.preventDefault();
            const message = this.dataset.confirm;
            const title = this.dataset.confirmTitle || 'Konfirmasi';
            const type = this.dataset.confirmType || 'warning';
            
            if (await confirmAction(message, title, type)) {
                this.dataset.confirmed = 'true';
                this.submit();
            }
        });
    });
    
    // Handle buttons/links with data-confirm
    document.querySelectorAll('[data-confirm]:not(form)').forEach(el => {
        el.addEventListener('click', async function(e) {
            e.preventDefault();
            const message = this.dataset.confirm;
            const title = this.dataset.confirmTitle || 'Konfirmasi';
            const type = this.dataset.confirmType || 'warning';
            
            if (await confirmAction(message, title, type)) {
                if (this.tagName === 'A') {
                    window.location.href = this.href;
                } else if (this.form) {
                    this.form.submit();
                }
            }
        });
    });
});

// CSS for progress animation
const style = document.createElement('style');
style.textContent = `
    @keyframes shrink {
        from { width: 100%; }
        to { width: 0%; }
    }
    .toast-progress {
        animation: shrink 4000ms linear forwards;
    }
    [x-cloak] { display: none !important; }
`;
document.head.appendChild(style);
</script>
