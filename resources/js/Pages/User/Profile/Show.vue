<template>
    <pages-layout title="Profile">
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="profile.profile_photo_url" :alt="profile.username"
                        class="h-8 w-8 rounded-full object-cover">
                    <span class="capitalize ml-3">
                        {{`${profile.name}'의 프로필`}}
                    </span>

                </h2>

                <status :profile="profile" :isFriendsWith="isFriendsWith" :friendRequestSentTo="friendRequestSentTo"
                    :friendRequestRecievedFrom="friendRequestRecievedFrom"></status>

            </div>

        </template>

        <post-form :method="submit" :form="form" text="게시물 등록"></post-form>


        <infinite-scroll @loadMore="loadMorePosts">
            <combined-posts :posts="allPosts.data" :pagination="pagination"></combined-posts>
        </infinite-scroll>

    </pages-layout>
</template>


<script>
    import PostForm from '@/Components/PostComment/PostForm'
    import CombinedPosts from '@/Components/PostComment/CombinedPosts'
    import InfiniteScroll from '@/Components/InfiniteScroll'
    import PagesLayout from '@/Layouts/PagesLayout'
    import Status from '@/Components/FriendStatus/Status'
    export default {


        props: ['profile', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecievedFrom', 'posts', ],
        components: {
            PagesLayout,
            Status,
            CombinedPosts,
            PostForm,
            InfiniteScroll,

        },
        data() {
            return {
                form: this.$inertia.form({
                    body: this.body,
                    user_id: this.profile.id
                }),
                allPosts: this.posts
            }
        },
        computed: {
            pagination() {
                return this.allPosts = this.posts
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '등록 완료',
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


                        this.form.body = null
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


    }
</script>