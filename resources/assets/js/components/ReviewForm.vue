<template>
    <div>
     <form @submit.prevent="postReview">
        <div class="modal-body">
        <div class="form-group">
           <label for="Rating">Rate it:</label>
            <star-rating v-model="formData.rating"></star-rating>
        </div>
        <div class="form-group">
           <label for="Headline">Headline:</label>
            <input type="text" class="form-control" v-model="formData.headline" id="" value="" placeholder="Headline">
        </div>
        <div class="form-group">
           <label for="Headline">Description:</label>
            <input type="text" class="form-control" v-model="formData.description" id="" value="" placeholder="Description">
        </div>
        <input type="hidden" v-model="formData.product_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Submit</button>
         </div>
        </form>
    </div>
</template>
<script>
export default{
    props:['product','url'],
    data(){
        return{
            formData:{}
        }
    },
    
    methods:{
        postReview(){
            this.formData.product_id=this.product.id;
            axios.post(this.url,this.formData)
            .then(function(){
                location.reload();
            })
            .catch(function(){
                
            })
        }
    }
}
</script>