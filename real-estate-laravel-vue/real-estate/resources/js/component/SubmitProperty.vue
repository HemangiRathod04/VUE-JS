<template>
<div class="app-container">
    <Sidebar />
    <div class="main-content">
        <Header />
        <div class="dashboard-card">
            <div class="card">
                <div class="card-header">
                    <h2>Upload Properties</h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" class="form-control" placeholder="Enter Title" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="property-type">Property Type</label>
                                        <select id="property-type" class="form-control">
                                            <option value="">Select Property Type</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="house">House</option>
                                            <option value="condo">Condo</option>
                                            <option value="villa">Villa</option>
                                            <option value="land">Land</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" rows="5" class="form-control" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="property-status">Property Status</label>
                                        <select id="property-status" class="form-control">
                                            <option value="">Select Property Status</option>
                                            <option value="for-sale">For Sale</option>
                                            <option value="for-rent">For Rent</option>
                                            <option value="sold">Sold</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price (USD)</label>
                                        <input type="number" id="price" class="form-control" placeholder="Enter Price in USD" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area (sqft)</label>
                                        <input type="number" id="area" class="form-control" placeholder="Enter Area in sqft" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rooms">Rooms</label>
                                        <select id="rooms" class="form-control">
                                            <option value="">Select Number of Rooms</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Detailed Property Information</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="container">
                            <div class="row">
                                <!-- Property ID -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="property-id">Property ID</label>
                                        <input type="text" id="property-id" class="form-control" placeholder="Enter Property ID" />
                                    </div>
                                </div>

                                <!-- Area Size -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="area-size">Area Size (sqft)</label>
                                        <input type="number" id="area-size" class="form-control" placeholder="Enter Area Size" />
                                    </div>
                                </div>

                                <!-- Land Size -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="land-size">Land Size (sqft)</label>
                                        <input type="number" id="land-size" class="form-control" placeholder="Enter Land Size" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Bathrooms -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bathrooms">Bathrooms</label>
                                        <input type="number" id="bathrooms" class="form-control" placeholder="Enter Number of Bathrooms" />
                                    </div>
                                </div>

                                <!-- Garage -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="garage">Garage</label>
                                        <select id="garage" class="form-control">
                                            <option value="">Select Garage Availability</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Garage Size -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="garage-size">Garage Size (sqft)</label>
                                        <input type="number" id="garage-size" class="form-control" placeholder="Enter Garage Size" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Age Year -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="age-year">Age Year</label>
                                        <input type="number" id="age-year" class="form-control" placeholder="Enter Year of Construction" />
                                    </div>
                                </div>

                                <!-- Video URL -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="video-url">Video URL</label>
                                        <input type="url" id="video-url" class="form-control" placeholder="Enter Video URL" />
                                    </div>
                                </div>
                            </div>

                            <h6>Property Features</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="air-conditioning" class="form-check-input">
                                        <label for="air-conditioning" class="form-check-label">Air Conditioning</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="garage-facility" class="form-check-input">
                                        <label for="garage-facility" class="form-check-label">Garage Facility</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="swimming-pool" class="form-check-input">
                                        <label for="swimming-pool" class="form-check-label">Swimming Pool</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="fire-security" class="form-check-input">
                                        <label for="fire-security" class="form-check-label">Fire Security</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="fire-place" class="form-check-input">
                                        <label for="fire-place" class="form-check-label">Fire Place Facility</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="play-ground" class="form-check-input">
                                        <label for="play-ground" class="form-check-label">Play Ground</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="furniture" class="form-check-input">
                                        <label for="furniture" class="form-check-label">Furniture Include</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="marble-floor" class="form-check-input">
                                        <label for="marble-floor" class="form-check-label">Marble Floor</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="store-room" class="form-check-input">
                                        <label for="store-room" class="form-check-label">Store Room</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="high-class-door" class="form-check-input">
                                        <label for="high-class-door" class="form-check-label">High-Class Door</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="floor-heating" class="form-check-input">
                                        <label for="floor-heating" class="form-check-label">Floor Heating System</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="solar-energy" class="form-check-input">
                                        <label for="solar-energy" class="form-check-label">Solar Energy</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Property Media</h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="drop-zone" @drop.prevent="handleDrop" @dragover.prevent @click="fileInput.click()">
                                        <input type="file" ref="fileInput" multiple @change="handleFileSelect" style="display: none;" />
                                        <p>Drop your photos here or click to select.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="image-preview-container">
                                        <div v-for="(image, index) in images" :key="index" class="image-preview">
                                            <img :src="image" alt="Preview" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row mt-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" @click.prevent="saveMedia">
                                        Save Media
                                    </button>
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
import Header from './Header.vue';
import Sidebar from './sidebar.vue';

export default {
    components: {
        Header,
        Sidebar
    }
}

</script>

<style scoped>
.app-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.main-content {
    flex: 1;
    padding: 20px;
}

.dashboard-card .card {
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #ffffff;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e1e1e1;
    padding: 10px 20px;
    font-size: 1.25rem;
}

.card-body {
    padding: 20px;
}

.card-body .form-group {
    margin-bottom: 1rem;
}

.card-body .form-check {
    margin-bottom: .5rem;
}
</style>
