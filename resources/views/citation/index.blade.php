@extends('welcome')
@section('content')
  <div class="row" style="margin:auto;padding-top:10%;">
    {{-- <button id="scrape">scrape web</button> --}}
    <div class="col s12" id="jumpTo">
        <h3>Open Citation Reference</h3>
    </div>
    <div class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">search</i>
          <input type="text" id="citationSearchCreateBar">
          <label for="citationSearchCreateBar">Search for an entity by DOI</label>
        </div>
        <div class="col s4">
            <label>Citation Style</label>
            <select class="browser-default" id="citationStyleLanguage">
            <option value="acm-sigchi-proceedings">ACM SIGCHI Proceedings (2016)</option>
            <option value="apa-6th-edition">American Psychological Association 6th edition</option>
            <option value="mla-8th-edition">Modern Language Association 8th edition</option>
            <option value="harvard-cite-them-right">Cite Them Right 10th Edition - Harvard</option>
            <option value="harvard-cite-them-right-no-et-al">Cite Them Right 10th Edition - Harvard (no "et al.")</option>
            <option value="chicago-note-bibliography">Chicago Note Bibliography</option>
            <option value="ieee">IEEE</option>
            <option value="ieee-with-url">IEEE with URL</option>
            <option value="bibtex">BibTeX generic citation style</option>
            </select>
        </div>
      <div class="input-type col s2">
          <label for="citeNow">Create Citation</label>
          <button class="btn large" id="citeNow" style="width:100%;height:100%;padding-top:5%;background-color:#3b5998;">CITE</button>
      </div>
      </div>
      <div id="for04Error"></div>
    </div>
    <div class="row"  style="padding:0px;margin:auto;">
      <div class="col s12" >
        <div class="card-panel" style="border-radius:6px;box-shadow:none;border:3px dashed #dfe3ee;background-color:#f7f7f7;">
              <small style="text-align:center;"><p>+</p></small>
        </div>
      </div>
    </div>
    <div class="col s12 userCreatedCitations"></div>
    <div id="clearCreatedCitations" class="brand-logo center" style="padding:0px;margin:auto;"></div>
    <div class="col s12 citations"></div>
  </div>
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large" href="#jumpTo" style="background-color:#3b5998">
      <i class="large material-icons">arrow_drop_up</i>
    </a>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/citation.js')}}"></script>
@endsection