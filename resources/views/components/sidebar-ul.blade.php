<li class="branch relative flex flex-col">
    <i class="absolute left-2 top-3 pointer-events-none w-3 h-3 bg-brandYellow icon"></i>
    <a href="#" class="w-full py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white font-bold">
        <span class="ml-3">Category</span>
    </a>
    <span class="absolute right-2 top-3 pointer-events-none transition-all duration-500 icon indicator ">
        <svg class="w-4 h-4" width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.90182 16.3096L2.80298 9.39533L9.90182 2.48105" stroke="#83DBD6" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>

    <ul class="collapse transition duration-200">
        <x-sidebar-li route="{{ route('category.create') }}" value="Add Category" :class="$addCategory ?? ''" />
        <x-sidebar-li route="{{ route('category.create') }}" value="Add Category" :class="$addCategory ?? ''" />
    </ul>
</li>
<script>
    var menuTree = document.getElementById("menuTree");
    if (menuTree) {
        menuTree.querySelectorAll("ul").forEach(function(el, key, parent) {
            const elm = el.parentNode;
            // elm.classList.add("branch");
            // el.classList.add("collapse");

            elm.addEventListener("click", function(event) {
                if (elm === event.target || elm === event.target.parentNode) {

                    console.log(elm);
                    if (el.classList.contains('collapse')) {
                        elm.classList.add("open-menu");
                        el.classList.add("expand");
                        el.classList.remove("collapse");

                    } else {
                        elm.classList.remove("open-menu");
                        el.classList.add("collapse");
                        el.classList.remove("expand");
                    }
                }
            }, false);
        });
    }
</script>
