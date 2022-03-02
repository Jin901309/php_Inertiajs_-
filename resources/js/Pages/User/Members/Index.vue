<template>
   <Head title="Members" />
     <pages-layout>
        <template #title>
            <div class="flex flex-col sm:justify-between items-center sm:flex-row ">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <Link :href="route('members.index')" class="capitalize underline"> 
                    전체유저
                    </Link>
                 

                </h2>
                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    
                    <LInk :href="route('welcome')" class="underline hover:text-green-500">방문하기</LInk>
                </span>


            </div>

        </template>
        <infinite-scroll @loadMore="loadMoreMembers">
            <user-block :items="allMembers.data"></user-block>
        </infinite-scroll>
        
       


    </pages-layout>
</template>

<script>
import InfiniteScroll from '@/Components/InfiniteScroll'
import PagesLayout from '@/Layouts/PagesLayout'
import UserBlock from '@/Components/UserBlock'
import { Head, Link } from '@inertiajs/inertia-vue3';
export default {
    props: ['members',],

    components: {
        Head,
        Link,
        PagesLayout,
        UserBlock,
        InfiniteScroll,
    },
    data() {
        return {
             allMembers: this.members
        }
    },
    methods: {
            loadMoreMembers() {
                if (!this.allMembers.next_page_url) {
                    return
                }
                return axios.get(this.allMembers.next_page_url)
                    .then(resp => {
                        this.allMembers = {
                            ...resp.data,
                            data: [
                                ...this.allMembers.data, ...resp.data.data
                            ]
                        }
                    })
            }
        },

}
</script>