<template>
    <!-- <div class="md:grid md:grid-cols-3 md:gap-6"> -->
        
        <div class="">
            <form @submit.prevent="$emit('submitted')">
                <!-- <div class="shadow overflow-hidden sm:rounded-md"> -->
                    <div class="w-full px-3 py-3 ">
                        <!-- <div class="grid grid-cols-5 gap-1"> -->
                        <div class="flex flex-wrap">
                            <slot name="form"></slot>
                           
                        </div>
                         <div class="w-full px-4 py-3  text-right sm:px-6" v-if="hasActions">
                            <slot name="actions"></slot>
                        </div>
                    </div>

                    <!-- <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6" v-if="hasActions">
                        <slot name="actions"></slot>
                    </div> -->
                <!-- </div> -->
            </form>
        </div>
    <!-- </div> -->
</template>

<script>
    
    export default {
        computed: {
            hasActions() {
                return !! this.$slots.actions
            }
        }
    }
</script>
