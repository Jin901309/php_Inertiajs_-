<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="friendRequestRecievedFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-2"></ignore>
        </template>
        <template v-else-if="friendRequestSentTo">

            <h3 class="font-semibold text-md text-gray-800 leading-tight">
                보류
            </h3>
        </template>
        <template v-else-if="isFriendsWith">
            <form @submit.prevent="delFriend">
                <danger-button type="submit">
                    <spin name="ring" size="20px" v-if="loading">

                    </spin>
                    <template v-else>
                        친구 끊기
                        <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>

                    </template>


                </danger-button>
            </form>


        </template>

        <template v-else-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <blue-button type="submit" class="text-xs">


                    <spin name="ring" size="20px" v-if="loading">

                    </spin>


                    <template v-else>
                        친구 추가
                        <icon name="user-plus" class="w-4 h-4 fill-current ml-1"></icon>

                    </template>

                </blue-button>
            </form>



        </template>

    </div>

</template>

<script>
    import DangerButton from '@/Jetstream/DangerButton'
    import Accept from './Accept.vue'
    import BlueButton from '@/Components/Buttons/BlueButton'
    import Ignore from './Ignore.vue'
    import Spin from '@/Components/Spin/Spin'

    export default {
        props: ['profile', 'isFriendsWith', 'friendRequestSentTo', 'friendRequestRecievedFrom', ],
        components: {
            BlueButton,
            DangerButton,
            Accept,
            Ignore,
            Spin,

        },
        data() {
            return {
                addFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                delFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading: false,
            }
        },
        methods: {
            addFriend() {
                this.loading = true
                this.addFriendForm.post(this.route('friends.store', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.loading = false
                        this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '친구 추가 완료',
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
                    },
                })
            },
            delFriend() {
                this.loading = true
                this.delFriendForm.delete(this.route('friends.destroy', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.loading = false
                        this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '친구 삭제',
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
                    },
                })
            },
            showAlert() {
                // Use sweetalert2
                this.$swal('Hello Vue world!!!');
            },
        }

    }
</script>




