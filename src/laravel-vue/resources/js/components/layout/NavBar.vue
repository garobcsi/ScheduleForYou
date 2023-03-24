<template>
    <div class="bg-gray-900 text-gray-100 py-3.5 px-6 shadow md:flex justify-between
    items-center">
    
      <div class="flex items-center">
        <span class="text-green-500 text-xl mr-1">
            <i class=""></i>
        </span>
        <h1 class="text-xl">Designer</h1>
      </div>

      <ul class="md:flex md:items-center ">
        <li class="md:mx-4" v-for="link in Links">
            <a :href="link.link" class="text-xl hover:text-green-500">{{link.name}}</a>
        </li>
      </ul>

    </div> 

</template>

<script>
export default{
    setup(){
        Links = [
            {name : "Kezdőlap" , link : "#"},
            {name : "Szolgáltatások" , link : "#"},
            {name : "Rólunk" , link : "#"},
            {name : "Blog" , link : "#"},
            {name : "Elérhetőség" , link : "#"},
        ]

        return{Links}
    }

}

</script>

