<template>
  <div class="google-map">
    <div ref="elemento" class="google-map-container"></div>
    <template v-if="mapa">
      <slot name="default" :map="mapa"></slot>
    </template>
  </div>
</template>

<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import type { MapaLeaflet } from '@/maps/leaflet';

const props = withDefaults(
  defineProps<{
    config?: Record<string, unknown>;
    lat: number;
    lng: number;
    zoom: number;
  }>(),
  {
    config: () => ({}),
    lat: 0,
    lng: 0,
    zoom: 13,
  }
);

const elemento = ref<HTMLElement>();
const mapa = ref<MapaLeaflet>();

onMounted(() => {
  if (!elemento.value) {
    return;
  }

  const instancia = L.map(elemento.value).setView(
    [props.lat || 0, props.lng || 0],
    props.zoom || 13
  );
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap',
  }).addTo(instancia);
  mapa.value = instancia;
});

watch(
  () => [props.lat, props.lng, props.zoom],
  () => {
    if (props.lat == null || props.lng == null) {
      return;
    }
    mapa.value?.setView([props.lat, props.lng], props.zoom || 13);
  }
);

onBeforeUnmount(() => {
  mapa.value?.remove();
});
</script>

<style scoped>
.google-map,
.google-map-container {
  min-height: 100%;
  width: 100%;
  height: 100%;
}
</style>
