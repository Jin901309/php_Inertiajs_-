<template>
    <div>

        <Head :title="title" />



        <div class="flex flex-col min-h-scree">
            <nav class="bg-white border-b border-gray-100 w-full fixed z-20">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard.index')" class="h-full w-16 text-center">
                                <application-logo />

                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                                    소셜 미디어
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>


                                </jet-dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative flex">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                            class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-transparent transition duration-150 ease-in-out">
                                            <template v-if="$page.props.user">
                                                <span class="capitalize">
                                                    환영합니다.
                                                </span>
                                                <span class="ml-1 mr-2">
                                                    {{ $page.props.user.username }} !!
                                                </span>

                                            </template>
                                            <span class="capitalize" v-else> 환영합니다.</span>

                                            <img class="h-8 w-8 rounded-full object-cover ml-3"
                                                :src="$page.props.user.profile_photo_url"
                                                :alt="$page.props.user.name" />
                                        </button>


                                        <button type="button"
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-transparent transition duration-150 ease-in-out"
                                            v-else>
                                            <div>
                                                {{ $page.props.user.username }}
                                            </div>

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            계정 관리
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            프로필 설정
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')"
                                            v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                로그아웃
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                                <jet-dropdown align="right" width="96">
                                <template #trigger>
                                    <button class="mt-1 focus:outline-none">
                                        <div class="flex ml-2 relative">
                                            <icon name="bell" class="w-6 h-6"></icon>
                                            <template v-if="unreadNotifications.length > 0">
                                                <span class="text-white text-xs bg-red-600 rounded-full px-2 py-1 absolute bottom-2 left-3">
                                                    {{ unreadNotifications.length }}
                                                </span>
                                            </template>
                                        </div>
                                    </button>
                                </template>

                                <template #content v-if="notifications.length > 0">
                                    <Link :href="route('notifications.update')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-300 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        모두 읽음으로 표시
                                    </Link>

                                    <div class="border-t border-gray-100"></div>

                                    <notifications :unreads="unreadNotifications" :reads="readNotifications"></notifications>

                                </template>

                                <template #content v-else>
                                    <div class="block text-center px-4 py-2 text-xs text-gray-400">
                                        알림이 없습니다.
                                    </div>
                                </template>
                            </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                            소셜 미디어
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :href="route('profile.show')"
                                :active="route().current('profile.show')">
                                프로필
                            </jet-responsive-nav-link>


                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    로그아웃
                                </jet-responsive-nav-link>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>




            <div class="flex flex-wrap pt-16 sm:flex-nowrap">
                <!-- 사이드바 -->
                <side-bar>

                </side-bar>

 <!-- Page Content -->
            <main class="bg-gray-200 shadow rounded my-5 py-6 px-4 w-full sm:w-2/3 sm:mx-2 sm:my-3 md:mx-4 md:px-10 lg:mx-auto">
                <slot></slot>
            </main>
            
           

            </div>


           

           
        </div>
    </div>
</template>

<script>
    import {
        defineComponent
    } from 'vue'

    import ApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';
    import SideBar from '@/Components/SideBar'
     import Notifications from '@/Components/Notifications'

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            SideBar,
            ApplicationLogo,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Notifications,
            Link,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                unreadNotifications: this.$page.props.auth.unreadNotifications,
                readNotifications: this.$page.props.auth.readNotifications,
                notifications: this.$page.props.auth.notifications,
            }
        },
        // mounted() {
        //     this.listen()
        // },

        methods: {
            listen() {
                Echo.private(`App.Models.User.${this.$page.props.user.id}`)
                    .notification((notification) => {
                        let newUnreadNotifications = {
                            data: {
                                info: {
                                    avatar: notification.info.avatar,
                                    message: notification.info.message,
                                    link: notification.info.link,
                                    sent: notification.info.sent,
                                }
                            },
                            id: notification.id
                        }
                        this.unreadNotifications.push(newUnreadNotifications)
                        this.notifications.push(newUnreadNotifications)
                    })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>


<style scoped>
body.swal2-toast-shown .swal2-container.swal2-top-end, body.swal2-toast-shown .swal2-container .swal2-top-right{
    top: 60px;
}
</style>