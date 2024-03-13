class App {
    /**
     * Class toggler
     */
    activeClassToggler() {
        const togglers = document.querySelectorAll(".-js-toggler");
        if (togglers) {
            togglers.forEach((toggler) => {
                toggler.addEventListener("click", () => {
                    toggler.classList.toggle("active");
                });
            });
        }
    }
 
    /**
     * Execute on page ready
     */
    pageReady() {
        document.body.classList.add("loaded");
        document.body.classList.remove("preload");
    }

    init() {
        this.activeClassToggler();
        this.pageReady();
    }
}
const app = new App();
