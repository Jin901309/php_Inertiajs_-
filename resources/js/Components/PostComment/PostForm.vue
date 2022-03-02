<template>
 <form @submit.prevent="method" class="w-full">
            <div>
                <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full"
                :placeholder="`포스트 ${$page.props.user.username}`" v-model="form.body">

                </textarea>
            </div>
            <div class="flex justify-between my-3">
                <div>
                    <jet-input-error :message="form.errors.body"
                    class="mt-2"
                    v-if="form.errors.body"
                    ></jet-input-error>
                    <div>
                        <blue-button type="submit" class="text-xs" :class="{ 'opacity-25' : form.processing }"
                        :disable="form.processing"
                        >
                         <spin name="ring" size="20px" v-if="form.processing">

                        </spin>
                        <span v-else>{{ text }}</span>
                        </blue-button>
                    </div>
                </div>
            </div>

        </form>
</template>

<script>
import BlueButton from '@/Components/Buttons/BlueButton'
import Spin from '@/Components/Spin/Spin'
import JetInputError from '@/Jetstream/InputError'
export default {
    components: {
        BlueButton,
        Spin,
        JetInputError,


    },
    props: ['method', 'form', 'text'],
    
}
</script>