<div class="navbar bg-base-100 sticky top-0 z-[100] text-primary-content">
    <div class="flex-1">
        <a href="{{ url('') }}" class="btn btn-ghost normal-case text-xl">Denny</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1 hidden lg:flex content-start items-center gap-4">
            <li><a href="{{ url('projects') }}">Project</a></li>
            <li><a href="{{ url('#footer') }}">Contact</a></li>
        </ul>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </label>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 gap-4 jusfity-start items-stretch p-4">

                <li><a href="{{ url('projects') }}">Project</a></li>
                <li><a href="{{ url('#footer') }}">Contact</a></li>
            </ul>
        </div>
    </div>
</div>