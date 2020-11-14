<template>
    <app-layout>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-form-section @submitted="createService">
                        <template #title>
                            New About Creation
                        </template>

                        <template #description>
                            Description for the New Creation About for your app. 
                        </template>

                        <template #form>
                            
                            <div class=" sm:col-span-4">
                                <jet-label for="name" value="About Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                                <jet-input-error :message="form.error('name')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="description" value="About Description" />
                                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4" id="name" v-model="form.description"></textarea>
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="email" value="About Email" />
                                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autofocus />
                                <jet-input-error :message="form.error('email')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="phone" value="About Phone" />
                                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" autofocus />
                                <jet-input-error :message="form.error('phone')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="address" value="About Address" />
                                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" autofocus />
                                <jet-input-error :message="form.error('address')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="twitter" value="About Twitter" />
                                <jet-input id="twitter" type="text" class="mt-1 block w-full" v-model="form.twitter" autofocus />
                                <jet-input-error :message="form.error('twitter')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="instagram" value="About Instagram" />
                                <jet-input id="instagram" type="text" class="mt-1 block w-full" v-model="form.instagram" autofocus />
                                <jet-input-error :message="form.error('instagram')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="facebook" value="About Facebook" />
                                <jet-input id="facebook" type="text" class="mt-1 block w-full" v-model="form.facebook" autofocus />
                                <jet-input-error :message="form.error('facebook')" class="mt-2" />
                            </div>
                       
                        </template>

                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </jet-action-message>

                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </jet-button>

                            <inertia-link class=" button pl-4" :href = "route('services.list')" >  Back </inertia-link>
                        </template>
                    </jet-form-section>
                </template>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from './../../../Layouts/Core/AppLayout'
import JetActionMessage from './../../../Jetstream/ActionMessage'
import JetButton from './../../../Jetstream/Button'
import JetFormSection from './../../../Jetstream/FormSection'
import JetInput from './../../../Jetstream/Input'
import JetInputError from './../../../Jetstream/InputError'
import JetLabel from './../../../Jetstream/Label'
export default {
    components : {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },

    data() {
        return {
            form: this.$inertia.form({
                name : '',
                description : '',
                image: '',

            }, {
                bag: 'createService',
                resetOnSuccess: false,
            })
        }
    },

    methods: {
        createService() {
            this.form.post(route('services.store'), {
                preserveScroll: true
            });
        },
        onImageChange(e){
            console.log(e.target.files[0]);
            this.form.image = e.target.files[0];
        },
    },
    
}
</script>