<script setup>
import { reactive } from 'vue';
import { $post } from '../../composables/useApi.ts';

    const form = reactive({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const signUp = () => {
        $post('register', form)
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            });
    };
    
</script>

<template>
    <div class="flex-center h-full w-full">
        {{ form }}
        <v-form>
        <v-sheet width="600" class="p-4 space-y-7" rounded="lg" >
            <h1 class="text-center">Sign Up</h1>
            <v-divider></v-divider>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.name"
                        label="Name"
                        outlined
                        dense
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        outlined
                        dense
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.password"
                        label="Password"
                        outlined
                        type="password"
                        dense
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="form.password_confirmation"
                        label="Confirm Password"
                        type="password"
                        outlined
                        dense
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12">
                    <v-btn
                        color="primary"
                        block
                        @click="signUp"
                    >
                        Sign Up
                    </v-btn>
                </v-col>
            </v-row>
        </v-sheet>
    </v-form>
    </div>
</template>

<style scoped></style>