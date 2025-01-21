<script setup>
import { reactive } from 'vue';
import {$post} from '../../composables/useApi';

    const form = reactive({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const register = () => {
        $post('register', form).then((data) => {
            console.log(data);
        });
    }
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
                        @click="register"
                        color="primary"
                        block
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