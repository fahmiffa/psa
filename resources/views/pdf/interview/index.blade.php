@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<style>
    body {
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 9px;
    }

    table {
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <p style="text-align: center;font-size:12px">面 接 名 簿</p>
    @include('pdf.interview.header')
    <table border="1" cellspacing="0" style="width: 100%">
        <tr align="center">
            <td>順</td>
            <td>氏名</td>
            <td rowspan="3">現住所</td>
            <td>年齢</td>
            <td>身長(cm)</td>
            <td>飲酒</td>
            <td>生年月日</td>
            <td colspan="3" rowspan="3">在留資格要件</td>
        </tr>
        <tr align="center">
            <td rowspan="2">番号</td>
            <td rowspan="2">フリガナ</td>
            <td>性別</td>
            <td>体重(Kg)</td>
            <td>喫煙</td>
            <td>最終学歴</td>
        </tr>
        <tr align="center">
            <td>血液型</td>
            <td>利き手</td>
            <td>婚姻</td>
            <td>入学日</td>
        </tr>
        @foreach ($job->come as $item)
            @php
                if ($item->user->dataj) {
                    $data = $item->user->dataj;
                } else {
                    $data = $item->user->data;
                }

                $lisensi = $data->lisensi ? json_decode($data->lisensi)[0] : null;
            @endphp

            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->data->fullname }}</td>
                <td rowspan="3">
                    {{ $item->user->data->alamat }}, {{ $item->user->data->kec }}, {{ $item->user->data->prov }}
                </td>
                <td>{{ usia($item->user->data->date_birth) }}</td>
                <td>{{ $item->user->data->tall }}</td>
                <td>
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->alkohol }}
                    @endif
                </td>
                <td>{{ $item->user->data->date_birth }}</td>
                <td>{{ $lisensi ? $lisensi[0] : null }} {{ $lisensi ? $lisensi[2] : null }}</td>
                <td></td>
                <td>{{ $lisensi ? $lisensi[1] : null }}</td>
            </tr>
            <tr>
                <td align="center" rowspan="2">{{ $item->user->siswa->from }}</td>
                <td rowspan="2">
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->fullname }}
                    @endif
                </td>
                <td>
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->gender }}
                    @endif
                </td>
                <td>{{ $item->user->data->weight }}</td>
                <td>
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->smoker }}
                    @endif
                </td>
                <td></td>
                {{-- belum --}}
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>{{ $item->user->data->blood }}</td>
                <td>
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->hand }}
                    @endif
                </td>
                <td>
                    @if ($item->user->dataj)
                        {{ $item->user->dataj->married }}
                    @endif
                </td>
                <td>{{ date('Y-m-d', strtotime($item->user->data->created_at)) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @if ($loop->iteration % 7 == 0)
    </table>
    <div style="page-break-before: always;"></div>
    @include('pdf.interview.header')
    <table border="1" cellspacing="0" style="width: 100%">
        <tr align="center">
            <td>順</td>
            <td>氏名</td>
            <td rowspan="3">現住所</td>
            <td>年齢</td>
            <td>身長(cm)</td>
            <td>飲酒</td>
            <td>生年月日</td>
            <td colspan="3" rowspan="3">在留資格要件</td>
        </tr>
        <tr align="center">
            <td rowspan="2">番号</td>
            <td rowspan="2">フリガナ</td>
            <td>性別</td>
            <td>体重(Kg)</td>
            <td>喫煙</td>
            <td>最終学歴</td>
        </tr>
        <tr align="center">
            <td>血液型</td>
            <td>利き手</td>
            <td>婚姻</td>
            <td>入学日</td>
        </tr>
        @endif
        @endforeach
    </table>

    <div style="page-break-before: always;"></div>

    @foreach ($job->come as $item)
        @php
            if ($item->user->dataj) {
                $data = $item->user->dataj;
            } else {
                $data = $item->user->data;
            }
            $photo = $item->user->files->photo;

        @endphp
        <table border="0" cellspacing="0" cellpadding="5" style="width: 50%">
            <tr>
                <th colspan="6" style="text-align: left">Curriculum Vitae
                </th>
            </tr>
            <tr>
                <th style="text-align: left">
                    履歴書
                </th>
                <th style="width: 20%"></th>
                <th></th>
                <th></th>
                <th style="text-align:right">作成日 &nbsp;&nbsp;&nbsp;Tanggai dibuat</th>
                <th style="text-align:right"></th>
            </tr>
        </table>

        <table style="width: 50%; float:left; border-collapse:collapse; border: 1px solid black; text-align:center">
            <tr>
                <td
                    style="background-color: rgb(244, 175, 132); border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
                    氏名<br>
                    Name</td>
                <td colspan="4" style="border: 1px solid black;">{{ $data->fullname }}</td>
                <td rowspan="2" style="border: 1px solid black;">
                    <img width="60px"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents('storage/' . $photo)) }}" />
                </td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">生年月日<br>Tanggal Lahir</td>
                <td colspan="2" style="border: 1px solid black;">{{ $data->date_birth }}</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">性別<br>Jenis Kelamin</td>
                <td style="border: 1px solid black;">{{ $data->gender ? 'Perempuan' : 'Laki-laki' }}</td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">現住所<br>Alamat</td>
                <td colspan="5" style="border: 1px solid black;">{{ $data->alamat }}</td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">電話番号<br>No. Telpon</td>
                <td colspan="2" style="border: 1px solid black;">{{ $data->hp }}</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">メール<br>Email</td>
                <td colspan="2" style="border: 1px solid black;">{{ $data->email }}</td>
            </tr>
            <tr>
                <td rowspan="6" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Informasi
                </td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">身長<br>Tinggi Badan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">体重<br>Berat Badan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">握力<br>Kekuatan Cengkram</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">宗教<br>Agama</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">喫煙<br>Merokok</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">{{ $data->tall }} Cm</td>
                <td style="border: 1px solid black;">{{ $data->weight }} Kg</td>
                <td style="border: 1px solid black;">{{ $data->power }} Kg</td>
                <td style="border: 1px solid black;">
                    {{ $data->religion }}
                </td>
                <td style="border: 1px solid black;">{{ $data->smoker }}</td>
            </tr>

            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">婚姻<br>Status Perkawinan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">血液型<br>Golongan Darah</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">利き手<br>Tangan Dominan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">学習期間<br>Lama Belajar</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">飲酒<br>Minum Alkohol</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">{{ $data->married }}</td>
                <td style="border: 1px solid black;">{{ $data->blood }}</td>
                <td style="border: 1px solid black;">{{ $data->hand }}</td>
                <td style="border: 1px solid black;">{{ $data->learning }} Bulan</td>
                <td style="border: 1px solid black;">{{ $data->alkohol }}</td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">視力 <br>Daya penglihatan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">日本入国歴<br>Pernah ke jepang
                </td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">事故歴<br>Pernah kecelakaan
                </td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">病歴<br>Pernah sakit keras
                </td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">特技<br>Keahlian khusus</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">{{ $data->look }}</td>
                <td style="border: 1px solid black;">{{ $data->japan }}</td>
                <td style="border: 1px solid black;">{{ $data->accident }}</td>
                <td style="border: 1px solid black;">{{ $data->sick }}</td>
                <td style="border: 1px solid black;">{{ $data->skill }}</td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Hobbi</td>
                <td colspan="5" style="border: 1px solid black;">{{ $data->hobbies }}</td>
            </tr>

            {{-- study --}}
            <tr>
                <td colspan="6" style="background-color: #3F51B5; color:white; border: 1px solid black; ">学歴
                    Riwayat Pendidikan</td>
            </tr>
            <tr>
                <td colspan="3" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">期間 Periode
                </td>
                <td colspan="3" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">学校名 Nama
                    Sekolah</td>
            </tr>
            @php
                $job = json_decode($data->study);
            @endphp
            @for ($i = 0; $i < count($job); $i++)
                <tr>
                    <td colspan="3" style="border: 1px solid black;">{{ $job[$i][1] }}</td>
                    <td colspan="3" style="border: 1px solid black;">{{ $job[$i][0] }}</td>
                </tr>
            @endfor
            {{-- job --}}
            <tr>
                <td colspan="6" style="background-color: #3F51B5; color:white; border: 1px solid black; ">職歴
                    Pengalaman Pekerjaan</td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">企業名 Nama
                    Perusahaan</td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">期間 Periode
                </td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">職種
                    Pekerjaan</td>
            </tr>
            @if ($data->job)
                @php
                    $job = json_decode($data->job);
                @endphp
                @for ($i = 0; $i < count($job); $i++)
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">{{ $job[$i][0] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $job[$i][1] }} -
                            {{ $job[$i][2] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $job[$i][3] }}</td>
                    </tr>
                @endfor
            @endif

            {{-- magang --}}
            <tr>
                <td colspan="6" style="background-color: #3F51B5; color:white; border: 1px solid black; ">実習歴
                    Pengalaman Magang</td>
            </tr>
            <tr>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">実習先施設名</td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">期間 Periode
                </td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">業種 Industri
                </td>
            </tr>
            @if ($data->magang)
                @php
                    $magang = json_decode($data->magang);
                @endphp
                @for ($i = 0; $i < count($magang); $i++)
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">{{ $magang[$i][0] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $magang[$i][1] }} -
                            {{ $magang[$i][2] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $magang[$i][3] }}</td>
                    </tr>
                @endfor
            @endif

            {{-- lisensi --}}
            <tr>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">免許 ・資格
                    ・専門教育 Lisensi</td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">レベル Level
                </td>
                <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">取得日 Waktu
                    diperoleh</td>
            </tr>
            @if ($data->lisensi)
                @php
                    $lisensi = json_decode($data->lisensi);
                @endphp
                @for ($i = 0; $i < count($lisensi); $i++)
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">{{ $lisensi[$i][0] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $lisensi[$i][2] }}</td>
                        <td colspan="2" style="border: 1px solid black;">{{ $lisensi[$i][1] }}</td>
                    </tr>
                @endfor
            @endif
        </table>
        <table style="width: 45%; float:right; border-collapse:collapse; border: 1px solid black; text-align:center">
            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">仕事内容</td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Deskripsi
                    Pekerjaan</td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid black; ">{{ $data->job_des }}</td>
            </tr>

            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">実習で学んだ事
                </td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Hal yang
                    Dipelajari saat magang
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid black; ">{{ $data->magang_des }}</td>
            </tr>


            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">自己P㻾、希望、質問等
                </td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Promosi
                    diri, harapan, pertanyaan, dll.</td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid black; ">{{ $data->me }}</td>
            </tr>

            <tr>
                <td colspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">家族構成
                    Keluarga</td>
            </tr>
            <tr>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">続柄 Hubungan</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">家族氏名 Nama</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">年齢 Usia</td>
                <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Nomor HP</td>
            </tr>

            @php
                $val = json_decode($data->family);
            @endphp

            @isset($val->wali)
                <tr>
                    <td style="border: 1px solid black;">Wali</td>
                    @foreach ($val->wali as $item)
                        <td style="border: 1px solid black;">{{ $item }}</td>
                    @endforeach
                </tr>
            @endisset

            @isset($val->ayah)
                <tr>
                    <td style="border: 1px solid black;">Ayah</td>
                    @foreach ($val->ayah as $item)
                        <td style="border: 1px solid black;">{{ $item }}</td>
                    @endforeach
                </tr>
            @endisset

            @isset($val->ibu)
                <tr>
                    <td style="border: 1px solid black;">Ibu</td>
                    @foreach ($val->ibu as $item)
                        <td style="border: 1px solid black;">{{ $item }}</td>
                    @endforeach
                </tr>
            @endisset

            @isset($val->kaka)
                <tr>
                    <td style="border: 1px solid black;">Kaka</td>
                    @foreach ($val->kaka as $item)
                        <td style="border: 1px solid black;">{{ $item }}</td>
                    @endforeach
                    <td style="border: 1px solid black;"></td>
                </tr>
            @endisset

            @isset($val->adik)
                <tr>
                    <td style="border: 1px solid black;">Adik</td>
                    @foreach ($val->adik as $item)
                        <td style="border: 1px solid black;">{{ $item }}</td>
                    @endforeach
                    <td style="border: 1px solid black;"></td>
                </tr>
            @endisset
        </table>

        @if ($loop->last)
        @else
            <div style="page-break-before: always;"></div>
        @endif
    @endforeach

</body>

</html>
