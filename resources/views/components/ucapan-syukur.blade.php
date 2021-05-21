@props(['ucapanSyukur'])
<fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
    <legend class="px-2 text-lg">Ucapan Syukur:</legend>
    <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Gereja:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['gereja'] ?? 0)),3)))}},-</p><br/>
    <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Majelis:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['majelis'] ?? 0)),3)))}},-</p><br/>
    <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Pendeta:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pendeta'] ?? 0)),3)))}},-</p><br/>
    <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Guru Huria:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['guru_huria'] ?? 0)),3)))}},-</p><br/>
    <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Pembangunan:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pembangunan'] ?? 0)),3)))}},-</p><br/>
</fieldset>