<aside class="sidebar-wrapper fixed top-0 z-30 block h-full w-[308px] bg-white dark:bg-darkblack-600 xl:block">
    <div class="sidebar-header text-center relative z-30 flex h-[108px] w-full items-center border-b border-r border-b-[#F7F7F7] border-r-[#F7F7F7] dark:border-darkblack-400">
    
    <a href="{{route('home')}}" class="m-auto">
        <img class="block dark:hidden h-24" src="{{asset('images/logo/m2m-logo.svg')}}" alt="M2M Realty" /> 
        <img class="hidden dark:block h-24" src="{{asset('images/logo/m2m-logo.svg')}}" alt="M2M Realty" /> 
    </a>

    <button
        type="button"
        class="drawer-btn absolute right-0 top-auto"
        title="Ctrl+b"
    >
        <span>
        <svg
            width="16"
            height="40"
            viewBox="0 0 16 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
            d="M0 10C0 4.47715 4.47715 0 10 0H16V40H10C4.47715 40 0 35.5228 0 30V10Z"
            fill="#06b6d4"
            />
            <path
            d="M10 15L6 20.0049L10 25.0098"
            stroke="#ffffff"
            stroke-width="1.2"
            stroke-linecap="round"
            stroke-linejoin="round"
            />
        </svg>
        </span>
    </button>
    </div>
    <div class="sidebar-body overflow-style-none relative z-30 h-screen w-full overflow-y-scroll pb-[200px] pl-[48px] pt-[14px]">
    <div class="nav-wrapper mb-[36px] pr-[50px]">
        <div class="item-wrapper mb-5">
        <h4 class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50">Menu</h4>
        <ul class="mt-2.5">

            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('home')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Dashboard</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('listings.index')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Properties</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('developers.index')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Developers</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('downloadables.index')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Downloadables</span>
                        </div>
                    </div>
                </a>
            </li>

            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('downloadables.index')}}">
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                        <span class="item-ico">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        </span>
                        <span class="item-text font-medium leading-none">Categories</span>
                    </div>
                    <span>
                        <svg width="6" height="12" viewBox="0 0 6 12" fill="none" class="fill-current" xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            fill="currentColor"
                            d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                        />
                        </svg>
                    </span>
                    </div>
                </a>
                <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                    <li>
                    <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Marketing Inventory</a>
                    </li>
                    <li>
                    <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Sales</a>
                    </li>
                    <li>
                    <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Returned Items</a>
                    </li>
                    <li>
                    <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Sponsorship</a>
                    </li>
                    <li>
                    <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Pull-out w/ deadline</a>
                    </li>

                </ul>
            </li>
           
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('downloadables.index')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Teams</span>
                        </div>
                    </div>
                </a>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('downloadables.index')}}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2.5">
                            <span class="item-ico">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </span>
                            <span class="item-text font-medium leading-none">Downlines</span>
                        </div>
                    </div>
                </a>
            </li>
            @adminOrRole(['Super Admin'])
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="{{route('downloadables.index')}}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                        <span class="item-ico">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                            </svg>
                        </span>
                        <span class="item-text font-medium leading-none">Compensations & Benefits</span>
                    </div>
                </div>
            </a>
            </li>
            @endadminOrRole
            
            @adminOrRole(['Super Admin','Accounting'])
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="{{route('downloadables.index')}}">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>
                    </span>
                    <span class="item-text font-medium leading-none">Accounting</span>
                </div>
                <span>
                    <svg width="6" height="12" viewBox="0 0 6 12" fill="none" class="fill-current" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="currentColor"
                        d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                    />
                    </svg>
                </span>
                </div>
            </a>
            <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Sales Invoice</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Accounts Payable</a>
                </li>
            </ul>
            </li>
            @endadminOrRole
            @adminOrRole(['Super Admin','Marketing'])
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="{{route('downloadables.index')}}">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                    </span>
                    <span class="item-text font-medium leading-none">Marketing</span>
                </div>
                <span>
                    <svg width="6" height="12" viewBox="0 0 6 12" fill="none" class="fill-current" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="currentColor"
                        d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                    />
                    </svg>
                </span>
                </div>
            </a>
            <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Marketing Inventory</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Sales</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Returned Items</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Sponsorship</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Pull-out w/ deadline</a>
                </li>

            </ul>
            </li>
            @endadminOrRole
           
            @adminOrRole('Super Admin')
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="#">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                    </span>
                    <span class="item-text font-medium leading-none">Inventory</span>
                </div>
                <span>
                    <svg width="6" height="12" viewBox="0 0 6 12" fill="none" class="fill-current" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="currentColor"
                        d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                    />
                    </svg>
                </span>
                </div>
            </a>
            <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Stocks</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Products</a>
                </li>
                
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Products Brands</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Products Categories</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Products Units</a>
                </li>
                <li>
                <a href="{{route('downloadables.index')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Products Tags</a>
                </li>
                <li>
            </ul>
            </li>
            @endadminOrRole
            @adminOrRole('Super Admin')
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="calender.html">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                    </svg>

                    </span>
                    <span
                    class="item-text font-medium leading-none"
                    >Calender</span
                    >
                </div>
                </div>
            </a>
            </li>
            @endadminOrRole
            @adminOrRole('Super Admin')
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="{{route('user-history')}}">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                    </svg>
                    </span>
                    <span
                    class="item-text font-medium leading-none"
                    >User History</span
                    >
                </div>
                </div>
            </a>
            </li>
            @endadminOrRole
        </ul>
        </div>
        @adminOrRole('Super Admin')
        <div class="item-wrapper mb-5">
        <h4
            class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50"
        >
            Help
        </h4>
        <ul class="mt-2.5">
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="support-ticket.html">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
                    </span>
                    <span
                    class="item-text font-medium leading-none"
                    >Support</span
                    >
                </div>
                </div>
            </a>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <a href="#">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                    </svg>
                    </span>
                    <span
                    class="item-text font-medium leading-none"
                    >Settings</span
                    >
                </div>
                <span>
                    <svg
                    width="6"
                    height="12"
                    viewBox="0 0 6 12"
                    fill="none"
                    class="fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="currentColor"
                        d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                    />
                    </svg>
                </span>
                </div>
            </a>
            <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                <li>
                <a href="{{route('user-history')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Holidays</a>
                </li>
                <li>
                <a href="{{route('region-setting')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Regions</a>
                </li>
                <li>
                <a href="{{route('province-setting')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Provinces</a>
                </li>
                <li>
                <a href="{{route('citymun-setting')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">City/Municipalities</a>
                </li>
                <li>
                <a href="{{route('user-history')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Colors</a
                >
                </li>
            </ul>
            </li>
        </ul>
        </div>
        <div class="item-wrapper mb-5">
        <h4
            class="border-b border-bgray-200 text-sm font-medium leading-7 text-bgray-700 dark:border-darkblack-400 dark:text-bgray-50"
        >
            Others
        </h4>
        <ul class="mt-2.5">
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
                <a href="{{route('user-roles')}}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 8.735 8.735m0 0a.374.374 0 1 1 .53.53m-.53-.53.53.53m0 0L21 21M14.652 9.348a3.75 3.75 0 0 1 0 5.304m2.121-7.425a6.75 6.75 0 0 1 0 9.546m2.121-11.667c3.808 3.807 3.808 9.98 0 13.788m-9.546-4.242a3.733 3.733 0 0 1-1.06-2.122m-1.061 4.243a6.75 6.75 0 0 1-1.625-6.929m-.496 9.05c-3.068-3.067-3.664-7.67-1.79-11.334M12 12h.008v.008H12V12Z" />
                        </svg>

                    </span>
                    <span class="item-text font-medium leading-none">Access Control</span>
                    </div>
                    <span>
                    <svg
                        width="6"
                        height="12"
                        viewBox="0 0 6 12"
                        fill="none"
                        class="fill-current"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        fill="currentColor"
                        d="M0.531506 0.414376C0.20806 0.673133 0.155619 1.1451 0.414376 1.46855L4.03956 6.00003L0.414376 10.5315C0.155618 10.855 0.208059 11.3269 0.531506 11.5857C0.854952 11.8444 1.32692 11.792 1.58568 11.4685L5.58568 6.46855C5.80481 6.19464 5.80481 5.80542 5.58568 5.53151L1.58568 0.531506C1.32692 0.20806 0.854953 0.155619 0.531506 0.414376Z"
                        />
                    </svg>
                    </span>
                </div>
                </a>
                <ul class="sub-menu ml-2.5 mt-[22px] border-l border-success-100 pl-5">
                <li>
                    <a href="{{route('roles')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Roles</a>
                </li>
                <li>
                    <a href="{{route('role-permissions')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Permissions</a>
                </li>
                <li>
                    <a href="{{route('user-roles')}}" class="text-md inline-block py-1.5 font-medium text-bgray-600 transition-all hover:text-bgray-800 dark:text-bgray-50 hover:dark:text-success-300">Users w/ Roles</a>
                </li>
                </ul>
            </li>
            <li class="item py-[11px] text-bgray-900 dark:text-bgray-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <span class="item-ico">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>

                    </span>
                    
                    <a  onclick="event.preventDefault(); this.closest('form').submit();" href="{{route('logout')}}" class="focus:underline focus:text-indigo-700 focus:outline-none flex items-center">
                    <span class="item-text font-medium leading-none">Logout</span>
                    </a>
                </div>
                </div>
            </form>
            </li>
        </ul>
        </div>
        @endadminOrRole
    </div>
    
    <div class="copy-write-text">
        <p class="text-sm text-[#969BA0]">© @php echo date('Y'); @endphp All Rights Reserved</p>
        <p class="text-sm font-medium text-bgray-700">
        Made with ❤️ by
        <a href="https://efficientrix.com" target="_blank" class="border-b font-semibold hover:text-blue-600">Efficientrix IT Solutions</a>
        </p>
    </div>
    </div>
</aside>