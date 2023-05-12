<template>
    <div class="container">
      <h1 class="error-heading mt-5">{{ $t('error.title') }}</h1>
      <p class="error-message">{{ $t('error.txt') }}</p>
      <router-link to="/" class="error-link">{{ $t('error.button.txt') }}</router-link>
    </div>
</template>
  

  
<style scoped>
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    font-family: Arial, sans-serif;
    text-align: center;
    overflow: hidden; /* Added to hide scrollbars */
  }
  
  .error-heading {
    font-size: 5rem;
    font-weight: bold;
    color: #f44336;
  }
  
  .error-message {
    font-size: 2rem;
    margin-top: 2rem;
    color: #333;
  }
  
  .error-link {
    display: inline-block;
    margin-top: 2rem;
    padding: 1rem 2rem;
    border: 2px solid #333;
    border-radius: 4px;
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  
  .error-link:hover {
    background-color: #333;
    color: #fff;
  }
</style>