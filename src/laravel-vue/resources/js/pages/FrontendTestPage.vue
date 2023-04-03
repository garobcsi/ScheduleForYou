<template>
    <button @click="$refs.myVueperSlides[`${autoPlaying ? 'pause' : 'resume'}Autoplay`]();autoPlaying = !autoPlaying">
        {{ autoPlaying ? 'Pause' : 'Resume' }}
    </button>
    <button @click="pauseOnHover = !pauseOnHover">Pause on mouseover</button>
    <code>Currently {{ internalAutoPlaying ? 'playing' : 'paused' }}</code>

    <vueper-slides
        ref="myVueperSlides"
        autoplay
        :pause-on-hover="pauseOnHover"
        @autoplay-pause="internalAutoPlaying = false"
        @autoplay-resume="internalAutoPlaying = true">
        <vueper-slide
            v-for="(slide, i) in slides"
            :key="slide.id"
            :title="slide.title"
            :content="slide.content"
            :style="'background-color: ' + colors[i % 4]" />
        <template #pause>
            <i class="icon pause_circle_outline"></i>
        </template>
    </vueper-slides>
</template>

<script>
data: () => ({
    pauseOnHover: true,
    autoPlaying: true,
    internalAutoPlaying: true,
    slides: [
        {
            id: 'slide-1',
            title: 'Slide <b style="font-size: 1.3em;color: yellow">#1</b>',
            content: 'Slide title can be HTML.<br>And so does the slide content, <span style="font-size: 1.2em;color: yellow">why not?</span>'
        },
        // Other slides...
    ]
})
</script>

<style scoped>

</style>
