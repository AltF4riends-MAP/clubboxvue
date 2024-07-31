<template>
    <div class = "text-center">
        <v-dialog v-model="dialog" max-width="600px">
            <template v-slot:activator="{on}">
                <v-btn class="success" dark v-on="on">Pay</v-btn>
            </template>
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                    
                </v-card-title>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>