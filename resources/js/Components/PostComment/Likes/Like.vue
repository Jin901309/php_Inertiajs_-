<template>
    <div class="flex items-center">
        <span>{{ item.liked }}</span>
        <form @submit.prevent="method">
            <button type="submit" class="focus:outline-none">

                <icon name="like" class="w-3 h-3 hover:text-green-600 fill-current ml-1"></icon>

            </button>

        </form>

    </div>
</template>

<script>
export default {
    props: ['item', 'method'],
    
}
</script>