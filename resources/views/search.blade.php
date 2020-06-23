@include('includes.header')
  <div id="app">
   <div class="container">
    <ais-index app-id="{{ config('scout.algolia.id') }}"
                api-key="{{ env('ALGOLIA_SEARCH') }}"
                index-name="articles">
      <h1>Search for Article</h1>
      <ais-input placeholder="Search for a article..." class="form-control input-lg"></ais-input>
      <hr />

      <ais-results>
        <template scope="{result}">
          <div class="row" style="margin-top: 20px;">
            <div class="col-md-2">
             <img :src="{{'result.img'}}" alt="" width="80px" hight="70px">
             </div>
             <div class="col-md-10">
              <a :href="('/article/'+ result.slug )"><h3>@{{ result.title }}</h3></a>
            </div>
           
          </div>
        </template>
      </ais-results>
    </ais-index>
  </div>
</div>
@include('includes.footer')