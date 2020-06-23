<script>
import Like from './Like.vue';    
    
export default{
    props:['attributes'],
    
    components:{Like},
    
    data(){
        return{
            editing:false,
            content:this.attributes.content
        };
    },    
    methods:{
    update(){
    axios.patch('/update/'+ this.attributes.id,{
    content:this.content
    });
        this.editing=false;
      iziToast.success({
    title: 'success',
    message: 'Comment Updated Successfully!',
});
},
    destroy(){
        axios.delete('/delete/'+ this.attributes.id);
        
        $(this.$el).fadeOut(300,()=>{
            
               iziToast.info({
        title: 'Info',
        message: 'Your Comment have been Deleted!',
    });
            
        });

    }    
}
}
</script>