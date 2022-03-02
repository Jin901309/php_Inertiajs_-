<template>
    <Link :href="'/'">
         <img :src="'storage/images/social-media.png'" width="200" height="200" alt="lock">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
