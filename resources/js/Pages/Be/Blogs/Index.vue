<template>
    <app-layout>
        
        <template #navbar>
                    
            <ol class="flex items-center">
                <li class=" text-text-300 dark:text-text-dark-300 me-2 text-sm">Admin Dashboard ~ </li>
                <li class=" text-primary-500 me-3 text-sm">Blogs List</li>                
            </ol>
            
        </template>

        <template #header>
            <h2 class="mx-4 mt-6 text-lg font-semibold"> Blogs List </h2>
        </template>

         <template>
            <div class="m-4 bg-background-100 dark:bg-backgrounddark-700 rounded-lg overflow-hidden">
                
                <ps-form-horizontal-section @submitted=""> 
                    <template #form>   

                        <div class="flex justify-between w-full">    
                            <div class="flex items-center">
                                <!-- <jet-input id="name" type="text" class="w-full"  v-model="form.name" autofocus /> -->
                                <div class="relative text-gray-600 hidden sm:flex">
                                    <input type="search" name="serch" placeholder="Search blogs..." class="bg-background-500 dark:bg-backgrounddark-500 h-10 w-full xl:w-64 ps-5 pe-7 rounded-lg border border-background-300 dark:border-backgrounddark-700 text-sm focus:outline-none">
                                    <button type="submit" class="w-6 top-0 -ms-6 ">
                                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                                        </svg>
                                    </button>
                                </div>
                            
                            
                                <!-- w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mx-5 -->

                                <div class="mx-5">
                                    <jet-button class="text-text-500 dark:text-textdark-500 bg-background-500 hover:bg-background-300 dark:bg-backgrounddark-500 dark:hover:bg-backgrounddark-700 active:bg-primary-100" id='search' :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Search
                                    </jet-button>
                                </div>

                            </div>
                            <div class="flex items-center">
                                                
                                    <PsButton class=" bg-primary-500 hover:bg-primary-700 active:bg-primary-100 me-2"> 
                                        <inertia-link href="/blogs/create"> New Blog </inertia-link>
                                    </PsButton>

                                    <PsButton class=" text-text-500 dark:text-textdark-500 bg-background-500 hover:bg-background-300 dark:bg-backgrounddark-500 dark:hover:bg-backgrounddark-700 active:bg-primary-100 me-2">   
                                        <AppIcon name="plus"  />
                                    </PsButton>
                                    <PsButton class=" text-text-500 dark:text-textdark-500 bg-background-500 hover:bg-background-300 dark:bg-backgrounddark-500 dark:hover:bg-backgrounddark-700 active:bg-primary-100 me-2">   
                                        <AppIcon name="printer"  />
                                    </PsButton>
                                    
                                
                            </div>
                        </div>
                    </template>
                    <template #actions>
                        
                    </template>
                </ps-form-horizontal-section>

                <div class="" >
                    <table class="w-full ">
                        <thead >
                            <tr class="border-b ">
                                <th class="px-4 py-4">No</th>
                                <th class="px-4 py-4">Photo</th>
                                <th class="px-4 py-4">NAME</th>
                                <th class="px-4 py-4">DESCRIPTION</th>
                                <th class="px-4 py-4">ACTIONS</th>
                                
                            </tr>
                        </thead>
                        <tbody class="container text-center">
                            
                            <tr v-for="(blog, index) in blogs.data" :key="index" class=" shadow-sm"> 
                                <td class="px-4 py-4">{{++index}}</td>  
                                <td class="px-4 py-4"><img class="rounded-full h-20 w-20 object-cover" :src="'/storage/uploads/thumbnails/' + blog.blog_photo_path"></td>              
                                <td class="px-4 py-4">{{blog.name}}</td>
                                <td class="px-4 py-4">{{blog.description}}</td>
                                <td class="py-2 py-4">
                                    <PsButton class=" bg-general-300"> 
                                        <inertia-link :href = "route('blogs.view', {blog: blog})" > Edit </inertia-link>                                      
                                    </PsButton>
                                    <PsButton class=" bg-general-200"> 
                                        <inertia-link :href = "route('blogs.delete', {blog: blog})" > Delete </inertia-link>                                      
                                    </PsButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <nav class="w-full px-4 py-2 mt-2 items-end justify-end sm:px-6 inline-flex bg-background-300 dark:bg-backgrounddark-900 ">
                        <div v-for="link in blogs.links" :key="link.path" class="row">
                            <div v-if="link.label == 'Previous'">
                                <div v-if="link.url != null">
                                    <inertia-link class="inline-flex me-2 items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" :href = "link.url" > 
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </inertia-link>                                        
                                </div>
                            </div>
                            <div v-else-if="link.label == 'Next'">
                                <div v-if="link.url != null">
                                    <inertia-link class="inline-flex ms-2 items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" :href = "link.url" >                                             
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </inertia-link>              
                                </div>                          
                            </div>
                            <div v-else>
                                <inertia-link class="-ms-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-red-700 transition ease-in-out duration-150" :class="link.active == true ? 'bg-blue-200 ' : '' " :href = "link.url" > {{link.label}} </inertia-link>                                        
                            </div>
                        </div>
                    </nav>
                    
                </div>
               <div v-for="blg in blgs" :key="blg.id" class="row">
                    <p>{{blg.name}}</p>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from './../../../Layouts/Core/AppLayout'
import JetInput from './../../../Jetstream/Input'
import PsFormHorizontalSection from './../../../Layouts/Components/Forms/PsFormHorizontalSection'
import JetButton from './../../../Jetstream/Button'
import JetLabel from './../../../Jetstream/Label'
import PsButton from './../../../Layouts/Components/Buttons/PsButton'
import AppIcon from "./../../../Layouts/Components/Icons/AppIcon";

export default {
    components : {
        AppLayout,
        JetInput,
        PsFormHorizontalSection,
        JetButton,
        JetLabel,
        PsButton,
        AppIcon
    },
    props: [
        'blogs'
    ],
    data() {
        return {
            form: this.$inertia.form({
                    name : '',
                    description : '',
                },{
                    bag: 'createBlog',
                    resetOnSuccess: false,
                }), 
            blgs : []
        }
    },
    mounted() {
        if(this.$i18n.locale == 'ar') {
            this.$i18n.locale =  'ar';
        }else {
            this.$i18n.locale =  'ar';
        }
    //    this.loadAllBlogs()
    },
    methods: {
        loadAllBlogs() {
            axios.get(route('blogs.getall')).then(response => {
                 console.log(response.data);
                 this.blgs = response.data;
                 } ).catch(error => console.log(error))
        },
        searchBlogs() {
            console.log('hello');
        }
    }
}
</script>