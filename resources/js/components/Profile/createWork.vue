<template>
    <div class="container">
        <!--Title: <input v-model="newTitle" name="title"/> <br/>
        Description: <input v-model="newDescription" name="description"/><br/>
        genre: <input v-model="newGenre" name="genre"/> <br/>
        <button @click="createWork">save</button>-->
        <div class="pt-5">Title</div>
        <div><input v-model="newTitle"/></div>
        <div class="pt-5">Description</div>
        <div><textarea v-model="newDescription"/></div>
        <div class="row">
            <div class="col-8">

                <div class="card my-4 mx-3">
                    <div class="d-flex p-2">
                        <button class="btn btn-primary m-2" @click="genreArr.push('romance')"> Romance </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('drama')"> Drama </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('comedy')"> Comedy </button>
                    </div>
                    <div class="d-flex p-2">
                        <button class="btn btn-primary m-2" @click="genreArr.push('action')"> Action </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('mystery')"> Mystery </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('historical')"> Historical </button>
                    </div>
                    <div class="d-flex p-2">
                        <button class="btn btn-primary m-2" @click="genreArr.push('sci-fi')"> Sci-Fi </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('sports')"> Sports </button>
                        <button class="btn btn-primary m-2" @click="genreArr.push('horror')"> Horror </button>
                    </div>
                </div>

            </div>

            <div class="col-4">

                <button class="btn btn-primary" @click="createWork">save</button>

                <div class="dropdown">
                    <button class="btn btn-primary" @click="ratingsDropDownOpen = !ratingsDropDownOpen">
                        Ratings: {{ratings}}
                    </button>
                    <input type="file" ref="coverImage" @change="handleCoverImage()"/>
                    <div v-if="ratingsDropDownOpen">
                        <li class="list-group-item" @click="setRatings('general')">General</li>
                        <li class="list-group-item" @click="setRatings('teens')">Teens</li>
                        <li class="list-group-item" @click="setRatings('mature')">Mature</li>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            newTitle: "",
            newDescription: "",
            genreArr: [],
            ratings: "general",
            coverImage: null,
            ratingsDropDownOpen: false
        }
    },
    mounted(){
    },
    methods:{
        /*saveEdit(){
            console.log(this.newTitle);
            axios.post("/edit-work/" + this.workId, {"title": this.newTitle,
            "description": this.newDescription,"genre":this.newGenre});
        }*/
        handleCoverImage(){
            this.coverImage = this.$refs.coverImage.files[0];
            //check for the type of file using last three letters
        },
        createWork(){
            console.log(this.coverImage);
            let formData = new FormData();
            formData.append('title', this.newTitle);
            formData.append('description', this.newDescription);
            formData.append('genres', JSON.stringify(this.genreArr));
            formData.append('rating', this.ratings);
            formData.append('coverImage', this.coverImage);
            /*axios.post("/create-work", {"title": this.newTitle,
            "description": this.newDescription,"genres": this.genreArr, "rating": this.ratings,
            "coverImage": this.coverImage}, {headers: {'Content-Type': 'multipart/form-data'}});
            */
           axios.post("/create-work", formData, {headers: {'Content-Type': 'multipart/form-data'}});
        },
        setRatings(rating){
            this.ratings = rating;
            this.ratingsDropDownOpen = !this.ratingsDropDownOpen 
        }
    }

}
</script>

<style scoped>
    .container{
        text-align: center;
    }
</style>
