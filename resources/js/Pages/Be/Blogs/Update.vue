<template>
    <app-layout>
        <template #header> 
            <!-- <div class="flex justify-start items-center">
            <inertia-link href="/products/list"> Blog List / </inertia-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update Blog
            </h2>
            </div> -->
            <div class=" rounded font-sans w-full">
                <ol class="list-reset flex text-gray-600 items-center">
                    <li><span class="mx-2">/</span></li>
                    <li><inertia-link href="/blogs/list" class=" text-blue-600 font-bold"> Blog List </inertia-link></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-400">Update Blog</li>
                </ol>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <template>
                    <jet-form-section @submitted="updateBlog">
                        <template #title>
                            Edit Blog Creation
                        </template>

                        <template #description>
                            Description for the Edit Blog for your app. 
                        </template>

                        <template #form>
                            
                            <div class=" sm:col-span-4">
                                <jet-label for="name" value="Blog Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                                <jet-input-error :message="form.error('name')" class="mt-2" />
                            </div>
                            <div class=" sm:col-span-4">
                                <jet-label for="description" value="Blog Description" />
                                <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" autofocus />
                                <jet-input-error :message="form.error('description')" class="mt-2" />
                            </div>
                            <!-- Blog Photo -->
                            <div class="col-span-6 sm:col-span-4">
                                <!-- Blog Photo File Input -->
                                <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview">

                                <jet-label for="photo" value="Blog Image" />

                                <!-- Current Blog Image -->
                                <div class="mt-2" v-show="! photoPreview">
                                    <img :src="'/storage/uploads/thumbnails/' + form.image" alt="Current Blog Image" class="rounded-full h-20 w-20 object-cover">
                                </div>

                                <!-- New Blog Image Preview -->
                                <div class="mt-2" v-show="photoPreview">
                                    <span class="block rounded-full w-20 h-20"
                                        :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                                    Select A New Photo
                                </jet-secondary-button>

                                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="form.image">
                                    Remove Photo
                                </jet-secondary-button>

                                <jet-input-error :message="form.error('photo')" class="mt-2" />
                            </div>
                        </template>

                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                Saved.
                            </jet-action-message>

                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </jet-button>

                            <inertia-link class=" button pl-4" :href = "route('blogs.list')" >  Back </inertia-link>
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
import JetSecondaryButton from './../../../Jetstream/SecondaryButton'

export default {
    components : {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    props: [
        'blog'
    ],
    data() {
        return {
            form: this.$inertia.form({
                name : this.blog.name,
                description : this.blog.description,
                image : this.blog.blog_photo_path
            }, {
                bag: 'updateBlog',
                resetOnSuccess: false,
            }),
            photoPreview: null,
        }
    },

    methods: {
        updateBlog() {
            if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0]
            }

            this.form.post(route('blogs.update', [this.blog, this.$page.user]), {
                preserveScroll: true
            });
        },
        selectNewPhoto() {
            this.$refs.photo.click();
        },
        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        deletePhoto() {
            this.$inertia.delete(route('blogs.destroy', {blog_id: this.blog}), {
                preserveScroll: true,
            }).then(() => {
                this.photoPreview = null
                location.reload();
            });
        },
    },
    
}
</script>