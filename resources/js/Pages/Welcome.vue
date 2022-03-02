<template>
    <Head title="Main" />
    <div class="flex justify-around items-center bg-gray-100 min-h-screen">
        <div class="w-3/5">
            <img :src="'storage/images/social.jpg'" alt="social">
        </div>
        <div>
            <h1 class="text-4xl font-semibold text-center">
                Social
            </h1>
            <div v-if="canLogin" class="flex justify-center space-x-6 mt-5 w-full">
                <Link :href="route('dashboard.index')" v-if="$page.props.user" class="text-lg text-gray-700 underline">
                    대쉬보드

                </Link>
                <template v-else>
                        <Link :href="route('login')"
                        class="text-white bg-gray-700 rounded px-3 py-1 hover:bg-gray-500 cursor-pointer"
                        >
                                로그인
                        </Link>
                        <Link v-if="canRegister"  :href="route('register')"
                        class="text-white bg-gray-700 rounded px-3 py-1 hover:bg-gray-500 cursor-pointer"
                        >
                                회원가입
                        </Link>
                </template>
            </div>

            <p class="mt-10 text-center"> {{ users_count }} 멤버 활동중 </p>
        </div>
    </div>

</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            users_count: Number,
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>
