<template>
    <div class="container" id="app">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">File Upload Component</div>
                    <div class="card-body">
                       <div class="row">
                          <div class="col-md-9">
                              <input type="file" v-on:change="onImageChange" class="form-control">
                          </div>
                          <div class="col-md-3">
                             <button class="btn btn-success btn-block" @click="uploadImage">Upload Image</button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                image:''
            }
        },
        methods:{
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files; 
                if(!files.length)
                    return; 
                
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader(); 
                let vm = this; 
                reader.onload = (e) => {
                    vm.image = e.target.result; 
                }
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/image/store',{image:this.image}).then(response=>{
                    console.log(response)
                })
            }
        }
    }
</script>