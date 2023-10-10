<button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
</button>
<div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel" data-simplebar="">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <div class="theme-option pb-4">
            <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
            <div class="d-flex align-items-center gap-3 my-3">
                <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style.min.css')"
                    class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
                    <i class="ti ti-brightness-up fs-7 text-primary"></i>
                    <span class="text-dark">Light</span>
                </a>
                <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style-dark.min.css')"
                    class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
                    <i class="ti ti-moon fs-7 "></i>
                    <span class="text-dark">Dark</span>
                </a>
            </div>
        </div>

    </div>
</div>
