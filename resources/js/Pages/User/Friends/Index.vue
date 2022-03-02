<template>
    <pages-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <span class="underline">
                        {{ `${$page.props.user.username}'의 친구 목록` }}
                    </span>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    
                    <Link :href="route('members.index')" class="underline hover:text-green-500">
                        전체 유저  보기
                    </Link>
                </span>
            </div>
        </template>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                친구요청 온 목록:
            </h3>
            <div v-if="requests.length <= 0">
                <h3>친구 요청이 온 게 없습니다.</h3>
            </div>
            <user-block :items="requests"></user-block>
        </div>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                친구 목록:
            </h3>
            <div v-if="friends.length <= 0">
                <h3>아직 친구가 없습니다.</h3>
            </div>
            <user-block :items="friends"></user-block>
        </div>
    </pages-layout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import PagesLayout from '@/Layouts/PagesLayout'
import UserBlock from '@/Components/UserBlock'

export default {
    props: ['friends', 'requests'],
    components: {
        PagesLayout,
        Link,
        UserBlock,
    }
    
}
</script>