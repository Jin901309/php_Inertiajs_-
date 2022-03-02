<template>
    <form @submit.prevent="ignoreRequest">
        <danger-button type="submit" class="text-xs">
            <spin name="ring" size="20px" v-if="loading">

            </spin>
            <template v-else>
                친구요청 취소
                <icon name="user-minus" class="w-4 h-4 fill-current ml-1"></icon>
            </template>

        </danger-button>
    </form>
</template>

<script>
    import Spin from '@/Components/Spin/Spin'
    import DangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile'],
        components: {
            DangerButton,
            Spin,
        },
        data() {
            return {
                loading: false,

            }
        },
        methods: {
            ignoreRequest() {
                this.loading = true

                this.$inertia.get(this.route('friends.deny', this.profile.id, {
                    onSuccess: () => {
                        this.loading = false
                        this.$swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '친구 요청 취소',
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
                }));

            }

        }
    }
</script>