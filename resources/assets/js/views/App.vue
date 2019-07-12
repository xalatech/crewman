<template>
  <div>
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
            Crewman
            </a>
            <div class="navbar-item is-hidden-desktop">
                <p class="control">
                    <a class="button is-primary" href="#">
                            <span class="icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        <span>Date</span>
                    </a>
                </p>
            </div>
        </div>
    </nav>
    <main class="py-4">
      <router-view></router-view>
    </main>
  </div>
</template>
<script>
export default {};
</script>
