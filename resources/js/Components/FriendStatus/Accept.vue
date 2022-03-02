<template>
    <form @submit.prevent="acceptFriend">
        <green-button type="submit" class="text-xs">
            <spin name="ring" size="20px" v-if="loading">

            </spin>
            <template v-else>
                친구요청 수락
                <icon name="user-plus" class="w-4 h-4 fill-current ml-1"></icon>

            </template>

        </green-button>
    </form>
</template>

<script>
    import Spin from '@/Components/Spin/Spin'
    import GreenButton from '@/Components/Buttons/GreenButton'
    import {
        Method
    } from '@inertiajs/inertia'

    export default {
        props: ['profile'],
        components: {
            GreenButton,
            Spin,
        },
        data() {
            return {
                acceptFriendForm: this.$inertia.form({
                    user: this.profile,
                    _token: this.$page.props.csrf_token,
                }),
                loading: false,
            }

        },
        methods: {
            acceptFriend() {
                this.loading = true
                this.acceptFriendForm.patch(this.route('friends.update', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.loading = false
                        this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '친구 요청 수락',
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
                    }
                })
            }

        }

    }
</script>