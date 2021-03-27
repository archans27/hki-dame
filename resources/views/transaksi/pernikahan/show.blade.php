<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kelahiran/Angkat Anak') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/pernikahan')"/>
                <form action="{{url('/pernikahan/'.$pernikahan->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$pernikahan->kepala_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">Alamat Orang Tua</p><p>{{$keluarga->alamat_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Nama Mempelai</p><p>{{$mempelai->nama ?? ''}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tempat, Tanggal Lahir Mempelai</p><p>{{$pernikahan->mempelai ? ($mempelai->tempat_lahir.', '.date("d-m-Y",strToTime($mempelai->tanggal_lahir))) : '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Nama Pasangan Mempelai</p><p>{{$pasangan_mempelai->nama ?? '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tempat, Tempat Lahir Pasangan Mempelai</p><p>{{$pernikahan->pasangan_mempelai ? ($pasangan_mempelai->tempat_lahir.', '.date("d-m-Y",strToTime($pasangan_mempelai->tanggal_lahir))) : '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal Pemberkatan</p><p>{{date("d-m-Y",strToTime($pernikahan->tanggal_pemberkatan ?? '-'))}}</p><br/>


                <table class="table-auto border">
                    <thead>
                        <tr class="bg-gray-400 text-gray-800 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left w-5">No.</th>
                            <th class="py-3 px-6 text-left w-40">Untuk</th>
                            <th class="py-3 px-6 text-center w-40">Dari Paranak</th>
                            <th class="py-3 px-6 text-center w-40">Dari Paboru</th>
                            <th class="py-3 px-6 text-center w-40">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <tr>
                            <td class="border text-center p-2">1</td>
                            <td class="border text-left p-2">Akte Nikah</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['akte_nikah'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['akte_nikah'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval(  (int)$ucapanSyukur['paranak']['akte_nikah']+(int)$ucapanSyukur['paboru']['akte_nikah'] )),3)))}}</td>
                        </tr>
                        <tr>
                            <td class="border text-center p-2">2</td>
                            <td class="border text-left p-2">Gereja</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['gereja'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['gereja'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['gereja']+(int)$ucapanSyukur['paboru']['gereja'] )),3)))}}</td>
                        </tr>
                            <td class="border text-center p-2">3</td>
                            <td class="border text-left p-2">Majelis</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['majelis'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['majelis'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['majelis']+(int)$ucapanSyukur['paboru']['majelis'] )),3)))}}</td>
                        </tr>
                        <tr>
                            <td class="border text-center p-2">4</td>
                            <td class="border text-left p-2">Pendeta</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['pendeta'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['pendeta'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['pendeta']+(int)$ucapanSyukur['paboru']['pendeta'] )),3)))}}</td>
                        </tr>
                        <tr>
                            <td class="border text-center p-2">5</td>
                            <td class="border text-left p-2">Guru Huria</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['guru_huria'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['guru_huria'])),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['guru_huria']+(int)$ucapanSyukur['paboru']['guru_huria'] )),3)))}}</td>
                        </tr>
                            <td class="border text-center p-2">6</td>
                            <td class="border text-left p-2">Sintua Sektor</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['sintua_sektor'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['sintua_sektor']  )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['sintua_sektor']+(int)$ucapanSyukur['paboru']['sintua_sektor'] )),3)))}}</td>
                        </tr>
                        <tr>
                            <td class="border text-center p-2">7</td>
                            <td class="border text-left p-2">Lainnya</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paranak']['lain_lain'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $ucapanSyukur['paboru']['lain_lain'] )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( (int)$ucapanSyukur['paranak']['lain_lain']+(int)$ucapanSyukur['paboru']['lain_lain'] )),3)))}}</td>
                        </tr>
                        @php
                            function sum($carry, $item)
                            {
                                $carry += (int)$item;
                                return $carry;
                            }
                            $totalParanak = array_reduce($ucapanSyukur['paranak'], "sum");
                            $totalPaboru = array_reduce($ucapanSyukur['paboru'], "sum");
                        @endphp
                        <tr class="bg-gray-200">
                            <td class="border text-right p-2" colspan="2"><strong>Total</strong></td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $totalParanak )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $totalPaboru )),3)))}}</td>
                            <td class="border text-right p-2">{{'Rp. '.strrev(implode('.',str_split(strrev(strval( $totalParanak + $totalPaboru )),3)))}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
