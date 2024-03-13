<template>
    <div >
	<!-- <p>Lat = {{lat}} Lon ={{lon}}</p> -->
	<p>{{this.position}}</p>
	<button @click="myFunction()">Click Me</button>
</div>

</template>

<script>
export default {
    data(){
        return{
            error: '',
            lat:'',
            lon:'',
            position:'',
        }
    },
   methods:{
    myFunction: function () {		
	 if(navigator.geolocation){
       navigator.geolocation.getCurrentPosition(position => {
        this.position = position.coords.longitude+","+position.coords.latitude;
      })
    }
   
    },

	}
}
</script>