<template>
    <pages-layout title="Dashboard">
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                        class="h-8 w-8 rounded-full object-cover">
                    <span class="capitalize ml-3">
                        소셜
                    </span>

                </h2>


            </div>

        </template>

       <post-form :method="submit" :form="form" text="게시물 등록"></post-form>

       <suggestion-block :suggestions="suggestions"></suggestion-block>

       

        <infinite-scroll @loadMore="loadMorePosts">
             <combined-posts :posts="allPosts.data" :pagination="pagination">
            </combined-posts>
           
        </infinite-scroll>

    </pages-layout>
</template>

<script>
    import {
        defineComponent
    } from 'vue'
    import InfiniteScroll from '@/Components/InfiniteScroll'
    import PostForm from '@/Components/PostComment/PostForm'
    import CombinedPosts from '@/Components/PostComment/CombinedPosts'
    import JetInputError from '@/Jetstream/InputError'
    import PagesLayout from '@/Layouts/PagesLayout.vue'
import { Method } from '@inertiajs/inertia'
import BlueButton from '@/Components/Buttons/BlueButton'
import Spin from '@/Components/Spin/Spin'

import SuggestionBlock from '@/Components/SuggestionBlock'


    export default defineComponent({
        props: ['combinePosts', 'suggestions'],
        components: {
            PagesLayout,
            JetInputError,
            CombinedPosts,
            BlueButton,
            Spin,
            PostForm,
            SuggestionBlock,
            InfiniteScroll,

        },
        data(){
            return {
                form: this.$inertia.form({
                    user_id: this.$page.props.user.id,
                    body: this.body
                }),
                allPosts: this.combinePosts
            }
        },
        //화면 업데이트
        computed: {
            pagination() {
                return this.allPosts = this.combinePosts
            }
        },
        methods: {
            submit(){
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                         this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '게시물 등록 완료',
                            timer: 2000,
                            width: '300',
                            height: '100',
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        });
                        this.form.body=null

                    }
                })
            },
          loadMorePosts() {
                if (!this.allPosts.next_page_url) {
                    return
                }
                return axios.get(this.allPosts.next_page_url)
                    .then(resp => {
                        this.allPosts = {
                            ...resp.data,
                            data: [
                                ...this.allPosts.data, ...resp.data.data
                            ]
                        }
                    })
            }

        }
    })
</script>