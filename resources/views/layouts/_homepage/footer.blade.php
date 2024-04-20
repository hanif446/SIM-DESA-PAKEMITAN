@php
    use App\Models\Galeri;
    use App\Models\Kontak;

    $galeri = Galeri::orderBy('created_at', 'desc')->limit(6)->get();
    $kontak = Kontak::where('id', 1)->first();
@endphp

<footer>
    <!-- Footer Area Start -->
    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <h3>Website Desa Pakemitan</h3>
                    <div class="textwidget">
                        <p>Website sangatlah penting untuk informasi tentang apa saja, contohnya untuk website desa pakemitan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title">Short Link</h3>
                        <ul class="menu">
                            <li><a href="#">Agenda Desa</a></li>
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="{{ route('homepage.demografi') }}">Demografi Desa</a></li>
                            <li><a href="{{ route('homepage.galeri') }}">Galeri</a></li>
                            <li><a href="{{ route('homepage.kontak') }}">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title">Kontak Kami</h3>
                        <ul class="contact-footer">
                            <li>
                                <strong>Alamat :</strong> <span>{{ $kontak ? $kontak->alamat : '-' }}</span>
                            </li>
                            <li>
                                <strong>Phone :</strong> <span>{{ $kontak ? $kontak->no_hp : '-' }}</span>
                            </li>
                            <li>
                                <strong>E-mail :</strong> <span><a href="#">{{ $kontak ? $kontak->email : '-' }}</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title">Galeri</h3>
                        <ul class="instagram-footer">
                            @forelse($galeri as $gambar)
                            <li><img style="width: 65px;height: 50px;" src="{{ asset('galeri/'.$gambar->foto) }}" alt=""></li>
                            @empty
                            <li>No images available</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer area End -->
</footer>
