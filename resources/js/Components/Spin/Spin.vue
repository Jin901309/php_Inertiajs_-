<template>
    
  
    <pulse-loader v-if="name==='pluse'" :loading="loading" :color="color" :size="size"></pulse-loader>
    <ring-loader v-if="name==='ring'" :loading="loading" :color="color1" :size="size"></ring-loader>
    <bounce-loader v-if="name==='bounce'" :loading="loading" :color="color" :size="size"></bounce-loader>
  
</template>



<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import RingLoader from 'vue-spinner/src/RingLoader.vue'
import BounceLoader from 'vue-spinner/src/BounceLoader.vue'

export default {
     props: ['name', 'size'],
  data () {
    return {
      color: '#ffffff',
      color1: '#5bc0de',
      
      margin: '2px',
      radius: '2px'
    }
  },
  components: {
    PulseLoader,
    RingLoader,
    BounceLoader
  }
}
</script>